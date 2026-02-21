<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // ── Section 1: Media ──
                Forms\Components\Section::make('Media')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Product Images')
                            ->image()
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->imagePreviewHeight('150')
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),

                // ── Section 2: General Information ──
                Forms\Components\Section::make('General Information')
                    ->icon('heroicon-o-information-circle')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn($state, callable $set) =>
                                $set('slug', Str::slug($state))
                            ),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Textarea::make('description')
                            ->columnSpanFull()
                            ->rows(3),
                    ]),

                // ── Section 3: Pricing & Stock ──
                Forms\Components\Section::make('Pricing & Stock')
                    ->icon('heroicon-o-currency-dollar')
                    ->columns(3)
                    ->schema([
                        TextInput::make('price')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        TextInput::make('stock')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText('Set to 0 for sold out'),

                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->inline(false),
                    ]),

                // ── Section 4: Classification ──
                Forms\Components\Section::make('Classification')
                    ->icon('heroicon-o-tag')
                    ->columns(2)
                    ->schema([
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('categoryRelation', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('sub_category_id', null))
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique('categories', 'slug'),
                            ]),

                        Select::make('sub_category_id')
                            ->label('Sub Category')
                            ->options(fn(Get $get) => SubCategory::query()
                                ->where('category_id', $get('category_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->helperText('Displayed as category tag on product detail page')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique('sub_categories', 'slug'),
                            ])
                            ->createOptionUsing(function (array $data, Get $get): int {
                                $data['category_id'] = $get('category_id');
                                return SubCategory::create($data)->getKey();
                            }),
                    ]),

                // ── Section 5: Product Display ──
                Forms\Components\Section::make('Product Display')
                    ->icon('heroicon-o-eye')
                    ->description('Content shown on the product detail page')
                    ->schema([
                        TextInput::make('subtitle')
                            ->label('Subtitle Banner')
                            ->placeholder('e.g. PRODUCED IN LIMITED STUDIO BATCHES')
                            ->helperText('Banner text shown below the description')
                            ->columnSpanFull(),

                        Textarea::make('details')
                            ->label('Product Details')
                            ->placeholder("Size: 68 cm x 23 cm\nColor: Black body, cream details\nMaterial: premium fabric blend")
                            ->helperText('One detail per line, each becomes a bullet point')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                // ── Section 6: Color Variants ──
                Forms\Components\Section::make('Color Variants')
                    ->icon('heroicon-o-swatch')
                    ->description('Add color options for this product. Leave empty if there are no color variants.')
                    ->schema([
                        Forms\Components\Repeater::make('colorVariants')
                            ->relationship()
                            ->schema([
                                TextInput::make('color_name')
                                    ->label('Color Name')
                                    ->required()
                                    ->placeholder('e.g. Red Rose'),
                                Forms\Components\ColorPicker::make('color_code')
                                    ->label('Color Code')
                                    ->required(),
                                FileUpload::make('image')
                                    ->label('Variant Image')
                                    ->image()
                                    ->directory('products/variants')
                                    ->imagePreviewHeight('100'),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Order'),
                            ])
                            ->columns(4)
                            ->columnSpanFull()
                            ->defaultItems(0)
                            ->collapsible()
                            ->reorderable()
                            ->orderColumn('sort_order')
                            ->addActionLabel('Add Color Variant'),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoryRelation.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subCategory.name')
                    ->label('Sub Category')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->sortable()
                    ->badge()
                    ->color(fn(int $state): string => $state > 0 ? 'success' : 'danger')
                    ->formatStateUsing(fn(int $state): string => $state > 0 ? $state : 'SOLD OUT'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
