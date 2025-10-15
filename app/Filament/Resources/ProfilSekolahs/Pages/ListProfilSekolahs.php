<?php

namespace App\Filament\Resources\ProfilSekolahs\Pages;

use App\Filament\Resources\ProfilSekolahs\ProfilSekolahResource;
use Filament\Resources\Pages\ListRecords;

class ListProfilSekolahs extends ListRecords
{
    protected static string $resource = ProfilSekolahResource::class;

    public function mount(): void
    {
        $profilSekolah = static::getModel()::first();

        if ($profilSekolah) {
            $this->redirect($this->getResource()::getUrl('edit', ['record' => $profilSekolah->id]));
        } else {
            $this->redirect($this->getResource()::getUrl('create'));
        }
    }
}
