<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-c-building-office-2';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make("name")
                        ->unique(ignoreRecord: true)->required() ,

                        Forms\Components\FileUpload::make("image")->nullable(),

                    
                    ]),


                ]),

                Forms\Components\Group::make()
                ->schema([

                Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Select::make('region_id')
                    ->label('Region')
                    ->relationship('region', 'name')  // Use the relationship defined in the model
                    ->required(),
                    Forms\Components\Textarea::make("map")
                    ->nullable()
                    ->rows(5)
                    ->extraInputAttributes(['class' => 'no-resize']),
                
                ])
                ])
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\ImageColumn::make('image')
                ->label(' '),
                Tables\Columns\TextColumn::make("name")->label('City Name')->searchable(),
                Tables\Columns\TextColumn::make('region.name')  // Column for region name
                ->label('Region')
                ->searchable(), 
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
