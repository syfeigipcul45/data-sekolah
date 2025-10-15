<?php

namespace App\Filament\Resources\TahunAjarans\Pages;

use App\Filament\Resources\TahunAjarans\TahunAjaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTahunAjarans extends ListRecords
{
    protected static string $resource = TahunAjaranResource::class;

    protected static ?string $title = 'Daftar Tahun Ajaran';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat Tahun Ajaran'),
        ];
    }
}
