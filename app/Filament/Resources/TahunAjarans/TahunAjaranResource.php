<?php

namespace App\Filament\Resources\TahunAjarans;

use App\Filament\Resources\TahunAjarans\Pages\CreateTahunAjaran;
use App\Filament\Resources\TahunAjarans\Pages\EditTahunAjaran;
use App\Filament\Resources\TahunAjarans\Pages\ListTahunAjarans;
use App\Filament\Resources\TahunAjarans\Schemas\TahunAjaranForm;
use App\Filament\Resources\TahunAjarans\Tables\TahunAjaransTable;
use App\Models\TahunAjaran;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TahunAjaranResource extends Resource
{
    protected static ?string $model = TahunAjaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected static ?string $recordTitleAttribute = 'TahunAjaran';

    protected static ?int $navigationSort = 2;
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $title = 'Tahun Ajaran';
    protected static ?string $navigationLabel = 'Tahun Ajaran';

    public static function shouldRegisterNavigation(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user && $user->hasRole('User');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('sekolah', function (Builder $query) {
                $query->where('user_id', Auth::id());
            });
    }

    public static function form(Schema $schema): Schema
    {
        return TahunAjaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TahunAjaransTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTahunAjarans::route('/'),
            'create' => CreateTahunAjaran::route('/create'),
            'edit' => EditTahunAjaran::route('/{record}/edit'),
        ];
    }
}
