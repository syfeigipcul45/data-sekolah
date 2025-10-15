<?php

namespace App\Filament\Resources\ProfilSekolahs\Pages;

use App\Filament\Resources\ProfilSekolahs\ProfilSekolahResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class EditProfilSekolah extends EditRecord
{
    protected static string $resource = ProfilSekolahResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Edit Profil Sekolah';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record->id]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record->user_id !== Auth::id()) {
            $this->halt();
        }

        return $data;
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Profil Sekolah berhasil diperbarui')
            ->success();
    }
}
