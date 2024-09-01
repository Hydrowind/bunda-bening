<?php

namespace App\Filament\Resources\LedgerResource\Widgets;

use App\Models\Ledger;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Number;
use Str;

class LedgerOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $cashflow = Ledger::groupBy('direction')
                        ->selectRaw('SUM(amount) AS sum, direction')
                        ->pluck('sum', 'direction');
        
        return [
            Stat::make('Sisa Kas Sekolah', Str::of(Number::currency($cashflow['IN'] - $cashflow['OUT'], 'IDR', 'id'))->replace(',00', ''))
        ];
    }
}
