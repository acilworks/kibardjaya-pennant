<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\ItemsRelationManager;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Orders';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Customer Information')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('order_number')
                            ->disabled()
                            ->label('Order Number'),
                        TextInput::make('customer_name')
                            ->disabled()
                            ->label('Customer Name'),
                        TextInput::make('customer_email')
                            ->disabled()
                            ->label('Customer Email'),
                        TextInput::make('total_amount')
                            ->prefix('Rp')
                            ->disabled()
                            ->label('Total Amount'),
                    ]),
                ]),

            Section::make('Payment & Fulfillment')
                ->description('Update order status and tracking information')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('payment_status')
                            ->disabled()
                            ->label('Payment Status'),
                        Select::make('order_status')
                            ->options(Order::getStatusOptions())
                            ->required()
                            ->label('Order Status')
                            ->helperText('Update status when processing or shipping'),
                        TextInput::make('tracking_number')
                            ->label('Tracking Number (No. Resi)')
                            ->placeholder('Enter tracking number')
                            ->helperText('Required when status is Shipped')
                            ->requiredIf('order_status', 'shipped'),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('customer_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->money('IDR', true)
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('order_status')
                    ->badge()
                    ->label('Status')
                    ->color(fn(string $state) => match ($state) {
                        'pending' => 'gray',
                        'processing' => 'info',
                        'shipped' => 'warning',
                        'delivered' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),
                TextColumn::make('tracking_number')
                    ->label('Tracking')
                    ->placeholder('-')
                    ->copyable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Order Date'),
            ])
            ->filters([
                SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                    ]),
                SelectFilter::make('order_status')
                    ->options(Order::getStatusOptions())
                    ->label('Order Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
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
