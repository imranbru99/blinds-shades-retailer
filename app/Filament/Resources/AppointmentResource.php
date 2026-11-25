<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Operations';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required()->maxLength(160),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->searchable()->required()->preload(),
            Forms\Components\Select::make('user_id')->relationship('user', 'name')->searchable()->preload()->label('Consultant'),
            Forms\Components\Select::make('type')->options([
                'measure' => 'In-Home Measure',
                'consult' => 'Showroom Consult',
                'install' => 'Installation',
                'service' => 'Service Call',
                'followup' => 'Follow-up',
            ])->required(),
            Forms\Components\Select::make('status')->options([
                'scheduled' => 'Scheduled',
                'confirmed' => 'Confirmed',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
                'no_show' => 'No Show',
            ])->default('scheduled')->required(),
            Forms\Components\DateTimePicker::make('starts_at')->required(),
            Forms\Components\DateTimePicker::make('ends_at'),
            Forms\Components\TextInput::make('address')->columnSpanFull(),
            Forms\Components\Textarea::make('notes')->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('starts_at')->dateTime()->sortable(),
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('customer.name')->searchable(),
            Tables\Columns\TextColumn::make('type')->badge(),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('user.name')->label('Consultant'),
        ])->defaultSort('starts_at')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
