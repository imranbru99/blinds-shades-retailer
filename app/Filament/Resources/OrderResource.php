<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Operations';

    protected static ?string $navigationLabel = 'Orders / Jobs';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('order_number')->required()->unique(ignoreRecord: true)->default(fn () => 'LW-'.now()->format('ymd').'-'.random_int(100, 999)),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->searchable()->required()->preload(),
            Forms\Components\Select::make('user_id')->relationship('user', 'name')->searchable()->preload()->label('Assigned to'),
            Forms\Components\Select::make('status')->options([
                'pending' => 'Pending',
                'measuring' => 'Measuring',
                'in_production' => 'In Production',
                'ready_to_install' => 'Ready to Install',
                'installed' => 'Installed',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ])->required(),
            Forms\Components\Select::make('priority')->options([
                'low' => 'Low',
                'normal' => 'Normal',
                'high' => 'High',
                'rush' => 'Rush',
            ])->default('normal'),
            Forms\Components\DatePicker::make('due_date'),
            Forms\Components\TextInput::make('install_address')->columnSpanFull(),
            Forms\Components\Repeater::make('items')
                ->relationship()
                ->schema([
                    Forms\Components\Select::make('product_id')->relationship('product', 'name')->searchable()->preload()
                        ->reactive()
                        ->afterStateUpdated(function ($state, Set $set) {
                            if ($product = \App\Models\Product::find($state)) {
                                $set('description', $product->name);
                                $set('unit_price', $product->price);
                            }
                        }),
                    Forms\Components\TextInput::make('description')->required(),
                    Forms\Components\TextInput::make('window_label')->label('Window'),
                    Forms\Components\TextInput::make('quantity')->numeric()->default(1)->required()
                        ->reactive()
                        ->afterStateUpdated(fn (Get $get, Set $set) => $set('line_total', (float) $get('quantity') * (float) $get('unit_price'))),
                    Forms\Components\TextInput::make('unit_price')->numeric()->prefix('$')->required()
                        ->reactive()
                        ->afterStateUpdated(fn (Get $get, Set $set) => $set('line_total', (float) $get('quantity') * (float) $get('unit_price'))),
                    Forms\Components\TextInput::make('line_total')->numeric()->prefix('$')->required(),
                ])
                ->columns(3)
                ->columnSpanFull()
                ->defaultItems(1),
            Forms\Components\TextInput::make('subtotal')->numeric()->prefix('$')->default(0),
            Forms\Components\TextInput::make('tax')->numeric()->prefix('$')->default(0),
            Forms\Components\TextInput::make('total')->numeric()->prefix('$')->default(0),
            Forms\Components\Textarea::make('notes')->rows(3)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'completed', 'installed' => 'success',
                        'cancelled' => 'danger',
                        'ready_to_install' => 'warning',
                        default => 'info',
                    }),
                Tables\Columns\TextColumn::make('priority')->badge(),
                Tables\Columns\TextColumn::make('total')->money('USD'),
                Tables\Columns\TextColumn::make('due_date')->date(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
