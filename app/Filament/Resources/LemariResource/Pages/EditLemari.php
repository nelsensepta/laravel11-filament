<?php

namespace App\Filament\Resources\LemariResource\Pages;

use App\Filament\Resources\LemariResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLemari extends EditRecord
{
    protected static string $resource = LemariResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
