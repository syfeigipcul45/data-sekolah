<?php

namespace App\Filament\Resources\TahunAjarans\Tables;

use App\Models\TahunAjaran;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;

class TahunAjaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('#')
                    ->rowIndex(),
                TextColumn::make('tahun_ajaran')
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
            ->defaultSort('tahun_ajaran', 'desc')
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->before(function (DeleteAction $action, $record) {
                        // Check if the tahun ajaran has related records
                        if ($record->hasRelatedRecords()) {
                            Notification::make()
                                ->title('Tidak dapat menghapus tahun ajaran')
                                ->body('Tahun ajaran ini memiliki data terkait dan tidak dapat dihapus.')
                                ->danger()
                                ->send();

                            $action->halt();
                        }
                    })
                    ->successNotification(
                        Notification::make()
                            ->title('Tahun ajaran dihapus')
                            ->success()
                    )
            ]);
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make(),
            //     ]),
            // ]);
    }
}
