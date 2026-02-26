<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavItemResource\Pages;
use App\Models\NavItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NavItemResource extends Resource
{
    protected static ?string $model = NavItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Navbar Menu';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Menu Item')
                    ->schema([
                        Forms\Components\TextInput::make('label')
                            ->required()
                            ->maxLength(100)
                            ->helperText('Teks yang ditampilkan di navbar'),

                        Forms\Components\TextInput::make('url')
                            ->label('URL')
                            ->maxLength(255)
                            ->helperText('Kosongkan jika menggunakan mega menu')
                            ->nullable(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('position')
                                    ->options([
                                        'left' => 'Kiri (sebelum logo)',
                                        'right' => 'Kanan (setelah logo)',
                                    ])
                                    ->required()
                                    ->default('left'),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('has_mega_menu')
                                    ->label('Mega Menu?')
                                    ->live()
                                    ->helperText('Aktifkan untuk menampilkan mega menu dropdown')
                                    ->default(false),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true),
                            ]),
                    ]),

                Forms\Components\Section::make('Mega Menu Configuration')
                    ->description('Kelola sidebar groups dan sub-items untuk mega menu ini')
                    ->icon('heroicon-o-squares-2x2')
                    ->visible(fn(Forms\Get $get): bool => (bool) $get('has_mega_menu'))
                    ->schema([
                        Forms\Components\Repeater::make('megaGroups')
                            ->label('Sidebar Groups')
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->reorderable()
                            ->collapsible()
                            ->cloneable()
                            ->itemLabel(fn(array $state): ?string => $state['label'] ?? 'Group baru')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->label('Group Label')
                                            ->required()
                                            ->maxLength(100)
                                            ->placeholder('e.g. Collection Type'),

                                        Forms\Components\TextInput::make('url')
                                            ->label('URL (opsional)')
                                            ->maxLength(255)
                                            ->placeholder('e.g. /shop?filter=type')
                                            ->nullable(),

                                        Forms\Components\TextInput::make('sort_order')
                                            ->label('Urutan')
                                            ->numeric()
                                            ->default(0),
                                    ]),

                                Forms\Components\Repeater::make('items')
                                    ->label('Sub-Items')
                                    ->relationship()
                                    ->orderColumn('sort_order')
                                    ->reorderable()
                                    ->collapsible()
                                    ->cloneable()
                                    ->itemLabel(fn(array $state): ?string => $state['label'] ?? 'Item baru')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('label')
                                                    ->label('Item Label')
                                                    ->required()
                                                    ->maxLength(100)
                                                    ->placeholder('e.g. Pennants'),

                                                Forms\Components\TextInput::make('url')
                                                    ->label('URL')
                                                    ->maxLength(255)
                                                    ->placeholder('e.g. /shop?subcategory=pennants')
                                                    ->nullable(),

                                                Forms\Components\TextInput::make('sort_order')
                                                    ->label('Urutan')
                                                    ->numeric()
                                                    ->default(0),
                                            ]),
                                    ])
                                    ->defaultItems(0)
                                    ->addActionLabel('+ Tambah Item'),
                            ])
                            ->defaultItems(0)
                            ->addActionLabel('+ Tambah Group'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->limit(30),
                Tables\Columns\TextColumn::make('position')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'left' => 'info',
                        'right' => 'success',
                    }),
                Tables\Columns\IconColumn::make('has_mega_menu')
                    ->label('Mega Menu')
                    ->boolean(),
                Tables\Columns\TextColumn::make('mega_groups_count')
                    ->label('Groups')
                    ->counts('megaGroups')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->defaultSort('position')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('position')
                    ->options([
                        'left' => 'Kiri',
                        'right' => 'Kanan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNavItems::route('/'),
            'create' => Pages\CreateNavItem::route('/create'),
            'edit' => Pages\EditNavItem::route('/{record}/edit'),
        ];
    }
}
