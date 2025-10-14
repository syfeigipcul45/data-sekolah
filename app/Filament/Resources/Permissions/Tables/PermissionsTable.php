<?php

namespace App\Filament\Resources\Permissions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class PermissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->before(function (DeleteAction $action) {
                        $record = $action->getRecord();
                        if ($record->roles()->count() > 0) {
                            Notification::make()
                                ->danger()
                                ->title('Cannot Delete Permission')
                                ->body('This permission is assigned to one or more roles and cannot be deleted.')
                                ->send();
                            
                            $action->cancel();
                            return;
                        }
                    })
                    ->after(function () {
                        Notification::make()
                            ->success()
                            ->title('Permission Deleted')
                            ->body('The permission has been deleted successfully.')
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function (DeleteBulkAction $action) {
                            $records = $action->getRecords();
                            foreach ($records as $record) {
                                if ($record->roles()->count() > 0) {
                                    Notification::make()
                                        ->danger()
                                        ->title('Cannot Delete Permissions')
                                        ->body('Some permissions are assigned to roles and cannot be deleted.')
                                        ->send();
                                    
                                    $action->cancel();
                                    return;
                                }
                            }
                        })
                        ->after(function () {
                            Notification::make()
                                ->success()
                                ->title('Permissions Deleted')
                                ->body('The selected permissions have been deleted successfully.')
                                ->send();
                        }),
                ]),
            ]);

    }
}
