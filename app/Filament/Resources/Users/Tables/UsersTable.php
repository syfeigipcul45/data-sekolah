<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                ->before(function (DeleteAction $action) {
                    $record = $action->getRecord();
                    if ($record->roles()->count() > 0) {
                        // Prevent deletion if the user has roles assigned
                        Notification::make()
                            ->danger()
                            ->title('User tidak dapat dihapus')
                            ->body('User ini memiliki peran yang ditetapkan dan tidak dapat dihapus.')
                            ->send();
                        $action->cancel();
                        return;
                    }
                })
                ->after(function () {
                    // Notify after successful deletion
                    Notification::make()
                        ->success()
                        ->title('User telah dihapus')
                        ->body('User berhasil dihapus.')
                        ->send();
                }),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
