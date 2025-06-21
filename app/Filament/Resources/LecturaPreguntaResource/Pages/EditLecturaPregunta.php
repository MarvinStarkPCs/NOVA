<?php

namespace App\Filament\Resources\LecturaPreguntaResource\Pages;

use App\Filament\Resources\LecturaPreguntaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLecturaPregunta extends EditRecord
{
    protected static string $resource = LecturaPreguntaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
