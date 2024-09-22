<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Filament\Resources\PlaceResource\RelationManagers;
use App\Models\Place;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
// use Filament\Forms\Components\RichEditor;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static ?string $navigationIcon = 'heroicon-m-map-pin';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make("name")->unique(ignoreRecord: true)->required()
                        ->reactive() // This makes the field reactive, allowing us to generate the slug in real-time
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make("slug")->unique(ignoreRecord: true)->required(),

                        Forms\Components\Select::make('categories')
                        ->label('Categories')
                        ->relationship('categories', 'name') // Use the relationship defined in the model
                        ->multiple() // Enable multiple selection
                        ->required(),
                        Forms\Components\Select::make('city_id')
                        ->label('city')
                        ->relationship('city', 'name') // Use the relationship defined in the model
                        ->required(),
                        Forms\Components\TextInput::make("phone_number")->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make("email")->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make("website")->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make("latitude")->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make("longitude")->unique(ignoreRecord: true),

                        Forms\Components\Select::make('status')
                        ->options([
                            'active' => 'active',
                            'unactive' => 'unactive',
                        ])


                        // Forms\Components\FileUpload::make("Image")
                    ])->columns(2)
                ])
                ,




                Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Textarea::make("map")
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->rows(5)
                        ->extraInputAttributes(['class' => 'no-resize']),
                        Forms\Components\Textarea::make("address")
                        ->unique(ignoreRecord: true)
                        ->required()
                        ->rows(5)
                        ->extraInputAttributes(['class' => 'no-resize']),


                        Forms\Components\RichEditor::make('description')->required(),



                        // Forms\Components\FileUpload::make("Image")
                    ])->columns(1)
                    ]),




                    Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make()
                        ->schema([

                            Forms\Components\FileUpload::make('images')  // Use 'images' as the input name
                            ->label('Images')
                            ->multiple()  // Allow multiple uploads
                            // ->disk('public') // Set the correct disk
                            ->directory('places') // Directory to store images
                            ->reactive() // Makes the input reactive
                            ->afterStateUpdated(function ($state) {
                                foreach ($state as $file) {
                                    // Here you can save the image paths to the database if needed
                                    // e.g., create an Image record and associate it with the Place
                                }
                            }),

    
    
    
                            // Forms\Components\FileUpload::make("Image")
                        ])->columns(1)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                Tables\Columns\ImageColumn::make('images.0.image') // Adjust according to your relationship
                ->label('First Image'),
                // ->defaultImage('/path/to/default/image.jpg'),
                Tables\Columns\TextColumn::make("name")->label('Name')->searchable(),
                Tables\Columns\TextColumn::make("view_count")->label('Views'),
                Tables\Columns\TextColumn::make("city.name")->label('City')->searchable(),
                Tables\Columns\IconColumn::make('status')
                ->icon(fn (string $state): string => match ($state) {
                    'active' => 'heroicon-c-bolt',
                    'unactive' => 'heroicon-o-x-mark',
                })
                ->color(fn (string $state): string => match ($state) {
                    'unactive' => 'warning',
                    'active' => 'success',
                    default => 'gray',
                })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Tables\Actions\De::make(),
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
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }
}
