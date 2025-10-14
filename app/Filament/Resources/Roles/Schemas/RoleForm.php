<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->minLength(2)
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Select::make('permissions')
                    ->multiple()
                    ->relationship('permissions', 'name')->preload()
            ]);
    }
}
