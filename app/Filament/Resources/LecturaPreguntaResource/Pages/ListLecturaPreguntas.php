<?php

namespace App\Filament\Resources\LecturaPreguntaResource\Pages;

use App\Filament\Resources\LecturaPreguntaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLecturaPreguntas extends ListRecords
{
    protected static string $resource = LecturaPreguntaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
