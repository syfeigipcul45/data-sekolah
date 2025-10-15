<?php

namespace App\Filament\Resources\TahunAjarans\Pages;

use App\Filament\Resources\TahunAjarans\TahunAjaranResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTahunAjaran extends CreateRecord
{
    protected static string $resource = TahunAjaranResource::class;

    protected static ?string $title = 'Buat Tahun Ajaran';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Tahun Ajaran berhasil dibuat')
            ->success();
    }
}
