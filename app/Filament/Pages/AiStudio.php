<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiStudio extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.ai-studio';

    protected static ?string $navigationGroup = 'AI';

    protected static ?string $title = 'AI Content Studio';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public string $result = '';

    public function mount(): void
    {
        $this->form->fill([
            'type' => 'blog',
            'prompt' => 'Write a short blog intro about choosing cellular shades for Denver winters.',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')->options([
                'blog' => 'Blog / Knowledge article',
                'product' => 'Product description',
                'automation' => 'Automation suggestion',
                'troubleshoot' => 'Troubleshooting tip',
            ])->required(),
            Forms\Components\Textarea::make('prompt')->required()->rows(5)->columnSpanFull(),
        ])->columns(1)->statePath('data');
    }

    public function generate(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->result = $ai->generateContent($state['prompt'], $state['type']);
        Notification::make()->title('Content generated')->success()->send();
    }
}
