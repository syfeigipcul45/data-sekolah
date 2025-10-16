<?php

namespace App\Filament\Resources\DataKelas\Pages;

use App\Filament\Resources\DataKelas\DataKelasResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditDataKelas extends EditRecord
{
    protected static string $resource = DataKelasResource::class;

    protected static ?string $title = 'Edit Data Kelas';

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Data Kelas berhasil diperbarui')
            ->success();
    }
}
