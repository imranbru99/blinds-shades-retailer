<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class AiAssistant extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static string $view = 'filament.pages.ai-assistant';

    protected static ?string $navigationGroup = 'AI';

    protected static ?string $title = 'AI Troubleshooting & Automation';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public string $reply = '';

    public function mount(): void
    {
        $this->form->fill([
            'mode' => 'troubleshoot',
            'message' => 'Roller shade telescopes to the right after a few cycles.',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('mode')->options([
                'troubleshoot' => 'Troubleshooting assistant',
                'automation' => 'Automation suggestions',
            ])->required(),
            Forms\Components\Textarea::make('message')->required()->rows(4)->columnSpanFull(),
        ])->statePath('data');
    }

    public function ask(AiService $ai): void
    {
        $state = $this->form->getState();
        $context = $state['mode'] === 'automation' ? 'admin-automation' : 'admin-troubleshoot';
        $this->reply = $ai->chat($state['message'], $context);
    }
}
