<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Invoice;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Finance';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('invoice_id')->relationship('invoice', 'invoice_number')->searchable()->required()->preload()
                ->reactive()
                ->afterStateUpdated(function ($state, Forms\Set $set) {
                    if ($invoice = Invoice::find($state)) {
                        $set('customer_id', $invoice->customer_id);
                    }
                }),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->searchable()->required()->preload(),
            Forms\Components\TextInput::make('amount')->numeric()->prefix('$')->required(),
            Forms\Components\Select::make('method')->options([
                'card' => 'Card',
                'cash' => 'Cash',
                'check' => 'Check',
                'ach' => 'ACH / Bank',
                'financing' => 'Financing',
            ])->default('card')->required(),
            Forms\Components\TextInput::make('reference')->maxLength(100),
            Forms\Components\DatePicker::make('paid_at')->required()->default(now()),
            Forms\Components\Textarea::make('notes')->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('paid_at')->date()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->searchable(),
            Tables\Columns\TextColumn::make('invoice.invoice_number')->label('Invoice'),
            Tables\Columns\TextColumn::make('amount')->money('USD'),
            Tables\Columns\TextColumn::make('method')->badge(),
            Tables\Columns\TextColumn::make('reference')->toggleable(),
        ])->defaultSort('paid_at', 'desc')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
