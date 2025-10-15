<?php

namespace App\Filament\Resources\TahunAjarans\Schemas;

use App\Models\ProfilSekolah;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TahunAjaranForm
{
    public static function configure(Schema $schema): Schema
    {
        $profilSekolah = ProfilSekolah::where('user_id', Auth::id())->first();

        return $schema
            ->components([
                Hidden::make('sekolah_id')
                    ->default($profilSekolah?->id),
                TextInput::make('tahun_ajaran')
                    ->required()
                    ->label('Tahun Ajaran')
                    ->placeholder('2025/2026'),
            ]);
    }
}
