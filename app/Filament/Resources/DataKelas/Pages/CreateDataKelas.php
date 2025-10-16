<?php

namespace App\Filament\Resources\DataKelas\Pages;

use App\Filament\Resources\DataKelas\DataKelasResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateDataKelas extends CreateRecord
{
    protected static string $resource = DataKelasResource::class;

    protected static ?string $title = 'Buat Data Kelas';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Data Kelas berhasil dibuat')
            ->success();
    }
}
