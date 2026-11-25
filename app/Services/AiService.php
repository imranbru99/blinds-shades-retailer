<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    protected array $faq = [
        'hours' => 'LumenWeave Shade Co. showroom hours are Monday–Friday 9am–6pm and Saturday 10am–4pm (Mountain Time). Sunday is by appointment only.',
        'measure' => 'We offer complimentary in-home measuring across the Denver metro. Book online or call (303) 555-0184 and a design consultant will confirm a window.',
        'install' => 'Professional installation is included on most custom orders. Typical installs take 1–3 hours depending on window count and mount type.',
        'motorized' => 'Yes — we carry motorized roller shades, cellular shades, and blinds with quiet battery or hardwired motors, plus smart-home integrations.',
        'lead time' => 'Stock shades ship in 3–5 business days. Custom fabric and motorized products usually take 2–4 weeks plus install scheduling.',
        'warranty' => 'Most products include a limited lifetime manufacturer warranty on mechanisms and a 1-year workmanship warranty on installation.',
        'cleaning' => 'Dust with a microfiber cloth or vacuum brush attachment. Avoid soaking fabric. We can recommend professional cleaning for delicate weaves.',
        'pricing' => 'Pricing depends on product type, size, fabric, and motorization. Complimentary consultations include fabric samples and a written estimate.',
        'showroom' => 'Visit our Cherry Creek showroom at 1840 Madison Street, Denver, CO 80206 to see full-size displays of blinds, shades, and sheers.',
        'child safety' => 'All cordless and motorized options meet current US child-safety standards. Ask us about cordless upgrades on existing treatments.',
    ];

    public function chat(string $message, string $context = 'public'): string
    {
        $message = trim($message);
        if ($message === '') {
            return 'Ask me about blinds, shades, measuring, installation, or showroom hours.';
        }

        if ($reply = $this->callOpenAi($message, $context)) {
            return $reply;
        }

        return $this->demoReply($message, $context);
    }

    public function generateContent(string $prompt, string $type = 'blog'): string
    {
        if ($reply = $this->callOpenAi($prompt, "generate:{$type}")) {
            return $reply;
        }

        return match ($type) {
            'product' => "Soft filtered daylight meets tailored craftsmanship. {$prompt} — engineered for precise light control, clean lines, and lasting fabric performance in American homes.",
            'automation' => "Automation idea: auto-create measuring appointments when a new web lead mentions \"in-home measure\", assign the nearest available consultant, and email a prep checklist with window photos requested.",
            'troubleshoot' => "Troubleshooting tip: if a roller shade telescopes, check level brackets first, then confirm fabric is tracking evenly on the tube. Re-center the shade and test a few full cycles before adjusting end caps.",
            default => "Light, privacy, and proportion shape every LumenWeave project. {$prompt}\n\nStart with how the room is used at different times of day, then choose opacity, mount style, and whether motorization will simplify daily living.",
        };
    }

    protected function callOpenAi(string $message, string $context): ?string
    {
        $apiKey = config('services.openai.key') ?: env('OPENAI_API_KEY');
        if (! $apiKey) {
            return null;
        }

        try {
            $system = 'You are the AI assistant for LumenWeave Shade Co., a US blinds and shades retailer in Denver, Colorado. Be concise, helpful, and focused on window treatments, measuring, installation, inventory, and customer service. Context: '.$context;

            $response = Http::withToken($apiKey)
                ->timeout(20)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
                    'messages' => [
                        ['role' => 'system', 'content' => $system],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'temperature' => 0.5,
                ]);

            if (! $response->successful()) {
                return null;
            }

            return $response->json('choices.0.message.content');
        } catch (\Throwable) {
            return null;
        }
    }

    protected function demoReply(string $message, string $context): string
    {
        $lower = Str::lower($message);

        foreach ($this->faq as $needle => $answer) {
            if (Str::contains($lower, $needle) || Str::contains($lower, Str::before($needle, ' '))) {
                return $answer.' (Demo AI — add OPENAI_API_KEY for live responses.)';
            }
        }

        if ($context === 'admin-troubleshoot') {
            return 'Check the shade mount level, confirm clutch/motor power, and verify fabric tracking. If the issue persists, schedule a service appointment and note the product SKU. (Demo mode)';
        }

        if ($context === 'admin-automation') {
            return 'Suggested automation: when an order status becomes "ready_to_install", create an install appointment draft and notify the assigned technician via email. (Demo mode)';
        }

        return 'Thanks for reaching out to LumenWeave Shade Co. We help Denver homes choose custom blinds, cellular shades, roman shades, and motorized treatments. Ask about hours, measuring, installation, motorization, lead times, or warranties — or book a free consultation. (Demo AI)';
    }
}
