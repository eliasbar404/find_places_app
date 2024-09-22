<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';


    protected static ?string $navigationGroup = "Categories";

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make()
                    ->schema([
                        TextInput::make("name")
                        ->unique(ignoreRecord: true)->required() ,
                        Forms\Components\Select::make('parent_id')
                        ->label('Parent Category')
                        ->relationship('parent', 'name')  // Use the relationship defined in the model
                        ->nullable(),

                        // Forms\Components\FileUpload::make("Image")
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make("name")->label('Category Name')->searchable()
            ])
            ->filters([

                // Tables\Filters\Filter::make('name')
                // ->label('Filter by Name')
                // ->query(fn (Builder $query, $data) => $query->where('name', 'like', "%{$data['name']}%"))
                // ->form([
                //     TextInput::make('name')
                //         ->label('Category Name')
                //         ->placeholder('Enter name to filter')
                //         ->required(),
                // ]),
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
            ])->searchable('name');;
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
