<?php

namespace App\Filament\Resources\DataKelas;

use App\Filament\Resources\DataKelas\Pages\CreateDataKelas;
use App\Filament\Resources\DataKelas\Pages\EditDataKelas;
use App\Filament\Resources\DataKelas\Pages\ListDataKelas;
use App\Filament\Resources\DataKelas\Schemas\DataKelasForm;
use App\Filament\Resources\DataKelas\Tables\DataKelasTable;
use App\Models\DataKelas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class DataKelasResource extends Resource
{
    protected static ?string $model = DataKelas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;

    protected static ?string $recordTitleAttribute = 'DataKelas';

    protected static ?int $navigationSort = 4;
    protected static string|\UnitEnum|null $navigationGroup = 'Settings';
    protected static ?string $title = 'Data Kelas';
    protected static ?string $navigationLabel = 'Data Kelas';

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
        return DataKelasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DataKelasTable::configure($table);
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
            'index' => ListDataKelas::route('/'),
            'create' => CreateDataKelas::route('/create'),
            'edit' => EditDataKelas::route('/{record}/edit'),
        ];
    }
}
