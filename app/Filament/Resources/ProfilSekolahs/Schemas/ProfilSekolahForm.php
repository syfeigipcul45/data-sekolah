<?php

namespace App\Filament\Resources\ProfilSekolahs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfilSekolahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_sekolah')
                    ->required(),
                TextInput::make('npsn')
                    ->label('NPSN')
                    ->required(),
                TextInput::make('alamat')
                    ->required(),
                TextInput::make('telepon')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('website'),
                TextInput::make('kepala_sekolah')
                    ->required(),
            ]);
    }
}
