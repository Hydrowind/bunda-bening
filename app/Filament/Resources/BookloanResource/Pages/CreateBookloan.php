<?php

namespace App\Filament\Resources\BookloanResource\Pages;

use App\Filament\Resources\BookloanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookloan extends CreateRecord
{
    protected static string $resource = BookloanResource::class;

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
