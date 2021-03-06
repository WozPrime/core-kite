<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTask;
use App\Models\Doc;
use App\Models\ProfTask;
use App\Models\ProfUser;
use Dompdf\Dompdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function generatePDF(Request $req)
    {
        $project_task = ProjectTask::all();
        $error = null;
        if ($req->dataKaryawan == '' &&
            $req->dataProyek == '' &&
            $req->dataProfesi == '' &&
            $req->reportList != "All" &&
            $req->reportList != "Tanggal"){
                Alert::error('Input masih kosong');
                return redirect()->back();
        }
        if (Auth::user()->role == 'member') {
            $project_task = $project_task->where('user_id',Auth::user()->id);
        }
        $input = null;
        $prof_task = ProfTask::all();
        $prof_name= null;
        if ($req->reportList == "Karyawan") {
            $input = $req->dataKaryawan;
            if($project_task->where('user_id',$input)->count()>0){
                $project_task = $project_task->where('user_id',$input);
            }else {
                $error = 2;
            }
        } 
        if ($req->reportList == "Tanggal") {
            if ($req->startDate > $req->endDate) {
                $temp = $req->startDate; 
                $req->startDate = $req->endDate;
                $req->endDate = $temp;
            }
            $from    = Carbon::parse($req->startDate)
                 ->startOfDay()        // 2018-09-29 00:00:00.000000
                 ->toDateTimeString(); // 2018-09-29 00:00:00

            $to      = Carbon::parse($req->endDate)
                            ->endOfDay()          // 2018-09-29 23:59:59.000000
                            ->toDateTimeString(); // 2018-09-29 23:59:59
            $input= [$from,$to];
            if($project_task->whereBetween('checked_at',$input)->count()>0){
                $project_task = $project_task->whereBetween('checked_at',$input);
            }else {
                $error = 3;
            }

        } 
        if ($req->reportList == "Proyek") {
            $input = $req->dataProyek;
            if($project_task->where('project_id',$input)->count()>0){
                $project_task = $project_task->where('project_id',$input);
            }else {
                $error = 3;
            }


        }
        if ($req->reportList == "Profesi") {
            $i = $req->dataProfesi;
            $input =[];
            $prof_task = $prof_task->where('prof_id',$i);
            $prof_name = ProfUser::find($i)->prof_name;
           
            foreach ($prof_task as $list) {
                $input[] = $list->task_id;
            }
            if($project_task->whereIn('task_id',$input)->count()>0){
                $project_task = $project_task->whereIn('task_id',$input);
            }else {
                $error = 4;
            }
        }
        if ($error > 1){
            if ($error == 2) {
                Alert::error('Karyawan Pada Proyek Masih kosong');
            } elseif ($error == 3) {
                Alert::error('Tugas Pada Proyek Masih kosong');
            } elseif ($error == 4) {
                Alert::error('Profesi Pada Proyek Masih kosong');
            }
                
            return redirect()->back();
        }
        

        $data = [
            'doc' => Doc::all(),
            'project_task' => $project_task,
            'report_opt' => $req->reportList,
            'input' => $input,
            'prof_name' => $prof_name,
        ];
          
        // $pdf = PDF::loadView('pages.progress.generatedPDF', $data);
        // $pdf->setPaper('A4', 'Landscape');
        // ini_set('max_execution_time', 0); 
        // return $pdf->stream('ReportPDF.pdf');
        return view('pages.progress.generatedPDF', $data);
        // $view = view('pages.progress.generatedPDF', $data);
        // $dompdf= new Dompdf();
        // $options = $dompdf->getOptions();
        // $options->setIsHtml5ParserEnabled(true);
        // $dompdf->loadHtml($view);
        // $dompdf->setPaper('A4', 'Landscape');
        // $dompdf->render();
        // $dompdf->stream($req->reportList."-Report.pdf");

    }

}
