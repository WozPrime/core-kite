<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTask;
use App\Models\Doc;
use App\Models\User;
use PDF;

class PDFController extends Controller
{
    // public function index()
    // {
    //     return view('generatedPDF', [
    //         'project_task' => ProjectTask::all(),
    //         'doc' => Doc::all(),
    //         'users' => User::all(),
    //     ]);
    // }

    public function generatePDF()
    {
        $data = [
            // 'doc' => Doc::all(),
            'project_task' => ProjectTask::all(),
        ];
          
        // $pdf = PDF::loadView('pages.progress.generatedPDF', $data);
        // $pdf->setPaper('A4', 'Landscape');
        // return $pdf->stream('ReportPDF.pdf');
        return view('pages.progress.generatedPDF', $data);
    }
}
