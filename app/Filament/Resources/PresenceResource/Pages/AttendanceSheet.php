<?php

namespace App\Filament\Resources\PresenceResource\Pages;

use App\Filament\Resources\PresenceResource;
use App\Models\Presence;
use App\Models\User;
use Filament\Resources\Pages\Page;

class AttendanceSheet extends Page
{
    protected static string $resource = PresenceResource::class;

    protected static string $view = 'filament.resources.presence-resource.pages.attendance-sheet';

    public function mount()
    {
        $this->students = User::all()->where('role', 'student');
        $this->dates = $this->getAttendanceDates();
    }

    protected function getAttendanceDates()
    {
        return Presence::select('date')->distinct()->pluck('date')->sort()->values();
    }

    public function getAttendanceData()
    {
        $attendances = Presence::all()->groupBy('user_id');
        return $attendances;
    }

    protected function beforeRender(): void
    {
        $this->students = User::all()->where('role', 'student');
        $this->dates = $this->getAttendanceDates();
    }
}
