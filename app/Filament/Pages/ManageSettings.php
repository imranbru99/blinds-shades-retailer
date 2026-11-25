<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $title = 'Settings';

    protected static ?int $navigationSort = 90;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'company_name' => Setting::getValue('company_name', 'LumenWeave Shade Co.'),
            'phone' => Setting::getValue('phone', '(303) 555-0184'),
            'email' => Setting::getValue('email', 'hello@lumenweave.example'),
            'address' => Setting::getValue('address', '1840 Madison Street, Denver, CO 80206'),
            'whatsapp' => Setting::getValue('whatsapp', '13035550184'),
            'tax_rate' => Setting::getValue('tax_rate', '8.31'),
            'showroom_hours' => Setting::getValue('showroom_hours', 'Mon–Fri 9–6, Sat 10–4'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('company_name')->required(),
            Forms\Components\TextInput::make('phone'),
            Forms\Components\TextInput::make('email')->email(),
            Forms\Components\TextInput::make('address')->columnSpanFull(),
            Forms\Components\TextInput::make('whatsapp')->helperText('Digits only for wa.me link'),
            Forms\Components\TextInput::make('tax_rate')->numeric()->suffix('%'),
            Forms\Components\TextInput::make('showroom_hours')->columnSpanFull(),
        ])->columns(2)->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();
        foreach ($state as $key => $value) {
            Setting::setValue($key, $value);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
