<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

// use Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('roles')->multiple()->relationship('roles', 'name'),
                TextInput::make('name')
                    ->required() // cannot empty
                    ->maxLength(255), // max char 255
                TextInput::make('email')
                    ->required() // cannot empty
                    ->email() // email validation
                    ->maxLength(255), // max char 255
                TextInput::make('password')
                    ->required() // cannot empty
                    ->password() //  password text input
                    ->revealable() // hide show password
                    ->maxLength(255), // max char 255
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('email')->badge(),

                // Tidak Dinamis Berdasarkan Role
                TextColumn::make('roles.name')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'warning',
                        'penulis' => 'success',
                        'super_admin' => 'danger',
                    }),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
