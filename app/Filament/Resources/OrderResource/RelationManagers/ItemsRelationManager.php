<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Placeholder::make('product_image')
                    ->label('Product Image')
                    ->content(function ($record) {
                        if (!$record) {
                            return 'No image';
                        }
                        $image = null;
                        if ($record->variation_name) {
                            $variant = \App\Models\ProductColorVariant::where('product_id', $record->product_id)
                                ->where('color_name', $record->variation_name)
                                ->first();
                            if ($variant && $variant->image) {
                                $image = $variant->image;
                            }
                        }
                        if (!$image && $record->product && $record->product->images) {
                            $image = is_array($record->product->images) ? $record->product->images[0] : null;
                        }
                        if (!$image && $record->custom_options && is_array($record->custom_options) && isset($record->custom_options['image'])) {
                            $image = $record->custom_options['image'];
                        }
                        if (!$image && is_string($record->custom_options)) {
                            $decoded = json_decode($record->custom_options, true);
                            if (is_array($decoded) && isset($decoded['image'])) {
                                $image = $decoded['image'];
                            }
                        }
                        if (!$image)
                            return 'No image';
                        return new \Illuminate\Support\HtmlString(
                            '<img src="' . asset('storage/' . $image) . '" class="w-24 h-24 object-cover rounded-lg">'
                        );
                    })
                    ->columnSpanFull(),
                Forms\Components\Placeholder::make('product_title')
                    ->label('Product')
                    ->content(fn($record) => ($record?->product?->title ?? $record?->product_name ?? 'Custom Pennant') . ($record?->variation_name ? ' (' . $record->variation_name . ')' : '')),
                Forms\Components\Placeholder::make('quantity_display')
                    ->label('Quantity')
                    ->content(fn($record) => $record?->quantity ?? '-'),
                Forms\Components\Placeholder::make('price_display')
                    ->label('Price')
                    ->content(fn($record) => 'Rp ' . number_format($record?->price ?? 0, 0, ',', '.')),
                Forms\Components\Placeholder::make('subtotal_display')
                    ->label('Subtotal')
                    ->content(fn($record) => 'Rp ' . number_format(($record?->price ?? 0) * ($record?->quantity ?? 0), 0, ',', '.')),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product.title')
            ->columns([
                Tables\Columns\ImageColumn::make('product_thumbnail')
                    ->label('Image')
                    ->circular()
                    ->size(40)
                    ->getStateUsing(function ($record) {
                        if (!$record->product && empty($record->custom_options) && empty($record->product_name)) {
                            return null;
                        }
                        if ($record->variation_name) {
                            $variant = \App\Models\ProductColorVariant::where('product_id', $record->product_id)
                                ->where('color_name', $record->variation_name)
                                ->first();
                            if ($variant && $variant->image) {
                                return asset('storage/' . $variant->image);
                            }
                        }
                        if ($record->product && $record->product->images) {
                            $images = $record->product->images;
                            if (is_array($images) && count($images) > 0) {
                                return asset('storage/' . $images[0]);
                            }
                        }
                        if ($record->custom_options) {
                            $options = is_string($record->custom_options) ? json_decode($record->custom_options, true) : $record->custom_options;
                            if (is_array($options) && isset($options['image'])) {
                                return asset('storage/' . $options['image']);
                            }
                        }
                        return null;
                    }),
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Product')
                    ->searchable()
                    ->getStateUsing(fn($record) => $record?->product?->title ?? $record?->product_name ?? '-')
                    ->formatStateUsing(fn(string $state, $record) => $state . ($record->variation_name ? ' (' . $record->variation_name . ')' : '')),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR', true),
                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->getStateUsing(fn($record) => $record->price * $record->quantity)
                    ->money('IDR', true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }
}
