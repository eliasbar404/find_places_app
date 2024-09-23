<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationLabel = 'Sub Admins';

    protected static ?string $navigationIcon = 'heroicon-s-user-group';


    public static function canViewAny(): bool
    {
        return Auth::user()->hasRole('super_admin');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make("name")->unique(ignoreRecord: true)->required(),
                        Forms\Components\TextInput::make("email")->unique(ignoreRecord: true)->required(),
                        Forms\Components\TextInput::make("password")->unique(ignoreRecord: true)->required(),
                        Forms\Components\Select::make('status')
                        ->options([
                            'active' => 'active',
                            'unactive' => 'unactive',
                        ])

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
                Tables\Columns\TextColumn::make("name")->label('Name')->searchable(),
                Tables\Columns\TextColumn::make("getRoleName")->label('role')->searchable(),
                Tables\Columns\TextColumn::make("email")->label('email')->searchable(),
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
