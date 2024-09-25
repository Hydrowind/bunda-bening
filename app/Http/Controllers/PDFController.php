<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $selectedMonth = $request->input('month') ?: Carbon::now()->format('Y-m');

        // Get the start and end dates of the month
        $startOfMonth = Carbon::create($selectedMonth)->startOfMonth();
        $endOfMonth = Carbon::create($selectedMonth)->endOfMonth();

        // Fetch students and their attendance
        // $students = Student::with(['attendance' => function ($query) use ($startOfMonth, $endOfMonth) {
        //     $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        // }])->get();

        $user = Auth::user();
                
        $members = User::all();
        if ($user->hasRole('teacher')) { 
            $members = User::role(['student', 'teacher'])->where('classroom', $user->classroom);
        }

        if ($user->hasRole('staff')) {
            $members = User::role(['student', 'staff', 'teacher']);
        }

        if ($user->hasRole('admin')) {
            $members = User::role(['student', 'staff']);
        }

        $students = User::whereIn('id', $members->pluck('id'))->with(['presences' => function ($query) use ($selectedMonth) {
            $startOfMonth = Carbon::create($selectedMonth)->startOfMonth();
            $endOfMonth = Carbon::create($selectedMonth)->endOfMonth();
            $query->whereBetween('date', [$startOfMonth, $endOfMonth]);
        }])->get();

        // Get all dates in the selected month
        $datesInMonth = [];
        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $datesInMonth[] = $date->copy();
        }

        // Pass the data to the view
        $pdf = Pdf::loadView('attendance-sheet-pdf', [
            'students' => $students,
            'datesInMonth' => $datesInMonth,
            'selectedMonth' => $selectedMonth,
        ])->setPaper('f4', 'landscape');;

        // Download the PDF file
        return $pdf->download('attendance-sheet-' . $selectedMonth . '.pdf');
    }
}
