<?php

namespace App\Filament\Resources\DataKelas\Schemas;

use App\Models\ProfilSekolah;
use Dom\Text;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class DataKelasForm
{
    public static function configure(Schema $schema): Schema
    {
        $profilSekolah = ProfilSekolah::where('user_id', Auth::id())->first();

        return $schema
            ->components([
                Hidden::make('sekolah_id')
                ->default($profilSekolah?->id),
                TextInput::make('nama_kelas')
                    ->required()
                    ->label('Nama Kelas')
                    ->placeholder('X IPA 1'),
            ]);
    }
}
