<?php

namespace App\Filament\Resources\LecturaResource\Pages;

use App\Filament\Resources\LecturaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLecturas extends ListRecords
{
    protected static string $resource = LecturaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
