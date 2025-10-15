<?php

namespace App\Filament\Resources\ProfilSekolahs;

use App\Filament\Resources\ProfilSekolahs\Schemas\ProfilSekolahForm;
use App\Models\ProfilSekolah;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProfilSekolahResource extends Resource
{
    protected static ?string $model = ProfilSekolah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Profil Sekolah';

    protected static ?string $title = 'Profil Sekolah';
    protected static ?string $navigationLabel = 'Profil Sekolah';

    protected static ?int $navigationSort = 1;
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return ProfilSekolahForm::configure($schema);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ProfilSekolahs\Pages\ListProfilSekolahs::route('/'),
            'create' => \App\Filament\Resources\ProfilSekolahs\Pages\CreateProfilSekolah::route('/create'),
            'edit' => \App\Filament\Resources\ProfilSekolahs\Pages\EditProfilSekolah::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user && $user->hasRole('User');
    }

    public static function canViewAny(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user && $user->hasRole('User');
    }

    public static function canCreate(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user && $user->hasRole('User');
    }

    public static function canEdit(Model $record): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user && $user->hasRole('User');
    }

    public static function canDelete(Model $record): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user && $user->hasRole('User');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
    }

    public static function getNavigationUrl(): string 
    {
        $profileExists = static::getModel()::where('user_id', Auth::id())->exists();
        
        return $profileExists 
            ? static::getUrl('edit', ['record' => static::getModel()::where('user_id', Auth::id())->first()->id])
            : static::getUrl('create');
    }
}
