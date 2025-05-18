<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Services\StudentFuzzyEvaluator;
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

    public function generateReportPDF(Request $request)
    {
        $evaluator = new StudentFuzzyEvaluator();

        $attitudeScore = 100;

        $sum = 0;
        for($i = 0; $i < count($_GET['knowledgeA']);) {
            $sum += $_GET['knowledgeA'][$i];
            $i++;
        }
        for($i = 0; $i < count($_GET['knowledgeB']);) {
            $sum += $_GET['knowledgeB'][$i];
            $i++;
        }
        for($i = 0; $i < count($_GET['knowledgeC']);) {
            $sum += $_GET['knowledgeC'][$i];
            $i++;
        }
        for($i = 0; $i < count($_GET['knowledgeD']);) {
            $sum += $_GET['knowledgeD'][$i];
            $i++;
        }
        for($i = 0; $i < count($_GET['knowledgeE']);) {
            $sum += $_GET['knowledgeE'][$i];
            $i++;
        }
        $knowledgeScore = $sum / (count($_GET['knowledgeA']) + count($_GET['knowledgeB']) + count($_GET['knowledgeC']) + count($_GET['knowledgeD']) + count($_GET['knowledgeE']));

        $sum = 0;
        for($i = 0; $i < count($_GET['skillA']);) {
            $sum += $_GET['skillA'][$i];
            $i++;
        }
        for($i = 0; $i < count($_GET['skillB']);) {
            $sum += $_GET['skillB'][$i];
            $i++;
        }
        for($i = 0; $i < count($_GET['skillC']);) {
            $sum += $_GET['skillC'][$i];
            $i++;
        }
        for($i = 0; $i < count($_GET['skillD']);) {
            $sum += $_GET['skillD'][$i];
            $i++;
        }
        for($i = 0; $i < count($_GET['skillE']);) {
            $sum += $_GET['skillE'][$i];
            $i++;
        }
        $skillScore = $sum / (count($_GET['skillA']) + count($_GET['skillB']) + count($_GET['skillC']) + count($_GET['skillD']) + count($_GET['skillE']));
        
        // Pass the data to the view
        $pdf = Pdf::loadView('student-report-pdf', [
            'knowledgeA' => $request->input('knowledgeA'),
            'knowledgeB' => $request->input('knowledgeB'),
            'knowledgeC' => $request->input('knowledgeC'),
            'knowledgeD' => $request->input('knowledgeD'),
            'knowledgeE' => $request->input('knowledgeE'),

            'skillA' => $request->input('skillA'),
            'skillB' => $request->input('skillB'),
            'skillC' => $request->input('skillC'),
            'skillD' => $request->input('skillD'),
            'skillE' => $request->input('skillE'),

            'evaluationResult' => $evaluator->evaluate($attitudeScore, knowledgeScore: $knowledgeScore, skillScore: $skillScore)
        ])->setPaper('a4', 'portrait');

        // Download the PDF file
        return $pdf->download('rapor-siswa.pdf');
    }

    public function generatePaycheckPDF(Request $request)
    {
        
        // Pass the data to the view
        $pdf = Pdf::loadView('pdf.paycheck-pdf', [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'period' => $request->input('period'),
            'base' => $request->input('base'),
            'transport' => $request->input('transport'),
            'meal' => $request->input('meal'),
            'gross' => $request->input('gross'),
            'bpjs' => $request->input('bpjs'),
            'loan' => $request->input('loan'),
            'deduction' => $request->input('deduction'),
            'netto' => $request->input('netto'),
        ])->setPaper('a4', 'portrait');

        // Download the PDF file
        return $pdf->download('slip-gaji.pdf');
    }
}
