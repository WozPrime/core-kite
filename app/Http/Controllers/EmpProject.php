<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProjectModel;
use App\Models\Instance;
use App\Models\Client;
use App\Models\InstancesModel;
use App\Models\User;
use App\Models\JobData;
use App\Models\Post;
use App\Models\Prof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpProject extends Controller
{
    public function index()
    {  
        return view('pages.emp.empproject', [
            'data' => ProjectModel::all(),
            'instansi' => Instance::all(),
            'klien' => Client::all(),
            'modelinstansi' => InstancesModel::all(),
        ]);
    }
}
