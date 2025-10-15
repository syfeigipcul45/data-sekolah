<?php

namespace App\Filament\Resources\ProfilSekolahs\Pages;

use App\Filament\Resources\ProfilSekolahs\ProfilSekolahResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class CreateProfilSekolah extends CreateRecord
{
    protected static string $resource = ProfilSekolahResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Buat Profil Sekolah';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record->id]);
    }

    protected function beforeCreate(): void
    {
        // Prevent creating multiple profiles per user
        if (static::getModel()::where('user_id', Auth::id())->exists()) {
            $this->redirect($this->getResource()::getUrl('edit', [
                'record' => static::getModel()::where('user_id', Auth::id())->first()->id
            ]));
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Profil Sekolah berhasil dibuat')
            ->success();
    }
}
