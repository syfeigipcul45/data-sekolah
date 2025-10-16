<?php

namespace App\Filament\Resources\DataKelas\Pages;

use App\Filament\Resources\DataKelas\DataKelasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDataKelas extends ListRecords
{
    protected static string $resource = DataKelasResource::class;

    protected static ?string $title = 'Data Kelas';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat Data Kelas'),
        ];
    }
}
