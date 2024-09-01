<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Siswa', User::whereHas('roles', fn ($q) => $q->where('name', 'student'))->get()->count()),
            Stat::make('Jumlah Guru', User::whereHas('roles', fn ($q) => $q->where('name', 'teacher'))->get()->count()),
            Stat::make('Jumlah Staff', User::whereHas('roles', fn ($q) => $q->where('name', 'staff'))->get()->count()),
        ];
    }
}
