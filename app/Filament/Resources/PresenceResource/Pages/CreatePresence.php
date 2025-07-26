<?php

namespace App\Filament\Resources\PresenceResource\Pages;

use App\Filament\Resources\PresenceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePresence extends CreateRecord
{
    protected static string $resource = PresenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Back')
                ->url(static::getResource()::getUrl('index'))
                ->color('gray'),
        ];
    }
}
