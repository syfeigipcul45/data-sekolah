<?php

namespace App\Filament\Widgets;

use App\Models\DataKelas;
use App\Models\ProfilSekolah;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        /** @var \App\Models\User|null */
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        return $user->hasRole('Admin')
            ? $this->getAdminStats()
            : $this->getUserStats($user);
    }

    protected function getAdminStats(): array
    {
        return [
            Stat::make('Total Pengguna', (string) User::query()
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'User');
                })->count())
                ->description('Jumlah pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Total Sekolah', (string) ProfilSekolah::count())
                ->description('Jumlah sekolah terdaftar')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('warning'),

            Stat::make('Total Kelas', (string) DataKelas::count())
                ->description('Jumlah seluruh kelas')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),
        ];
    }

    protected function getUserStats(User $user): array
    {
        $profilSekolah = ProfilSekolah::where('user_id', $user->id)->first();

        if (!$profilSekolah) {
            return [
                Stat::make('Profil Sekolah', 'Belum Lengkap')
                    ->description('Silahkan lengkapi profil sekolah')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color('danger'),
            ];
        }

        $totalKelas = DataKelas::where('sekolah_id', $profilSekolah->id)->count();
        $latestTahunAjaran = $profilSekolah->tahunAjarans()->orderBy('tahun_ajaran', 'desc')->first();

        return [
            Stat::make('Nama Sekolah', $profilSekolah->nama_sekolah)
                ->description('NPSN: ' . $profilSekolah->npsn)
                ->descriptionIcon('heroicon-m-building-library')
                ->color('success'),

            Stat::make('Jumlah Kelas', (string) $totalKelas)
                ->description('Total kelas yang terdaftar')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),

            Stat::make('Tahun Ajaran', $latestTahunAjaran ? $latestTahunAjaran->tahun_ajaran : 'Belum diatur')
                ->description($latestTahunAjaran ? 'Tahun ajaran aktif' : 'Silahkan atur tahun ajaran')
                ->descriptionIcon('heroicon-m-calendar')
                ->color($latestTahunAjaran ? 'success' : 'danger'),
        ];
    }
}
