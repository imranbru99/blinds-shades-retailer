<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Products / Shades';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(160),
            Forms\Components\TextInput::make('sku')->required()->unique(ignoreRecord: true)->maxLength(60),
            Forms\Components\Select::make('category')->required()->options([
                'wood_blinds' => 'Wood Blinds',
                'faux_wood' => 'Faux Wood Blinds',
                'cellular' => 'Cellular Shades',
                'roller' => 'Roller Shades',
                'roman' => 'Roman Shades',
                'sheer' => 'Sheer / Dual',
                'motorized' => 'Motorized Systems',
                'hardware' => 'Hardware & Parts',
            ]),
            Forms\Components\TextInput::make('fabric')->maxLength(100),
            Forms\Components\TextInput::make('color')->maxLength(80),
            Forms\Components\Textarea::make('description')->rows(3)->columnSpanFull(),
            Forms\Components\TextInput::make('price')->numeric()->prefix('$')->required(),
            Forms\Components\TextInput::make('cost')->numeric()->prefix('$')->default(0),
            Forms\Components\TextInput::make('stock_qty')->numeric()->required()->default(0),
            Forms\Components\TextInput::make('reorder_level')->numeric()->default(5),
            Forms\Components\Toggle::make('is_active')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('price')->money('USD'),
                Tables\Columns\TextColumn::make('stock_qty')->label('Stock')->sortable()
                    ->color(fn (Product $record) => $record->needsReorder() ? 'danger' : 'success'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->options([
                    'wood_blinds' => 'Wood Blinds',
                    'faux_wood' => 'Faux Wood Blinds',
                    'cellular' => 'Cellular Shades',
                    'roller' => 'Roller Shades',
                    'roman' => 'Roman Shades',
                    'sheer' => 'Sheer / Dual',
                    'motorized' => 'Motorized Systems',
                    'hardware' => 'Hardware & Parts',
                ]),
            ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
