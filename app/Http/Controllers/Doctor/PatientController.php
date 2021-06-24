<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('doctor');
    }

    public function index()
    {
        $data['title'] = 'All Patients';
        $data['sn'] = 1;
        $data['patients'] = Patient::orderBy('id', 'DESC')->get();
        return view('doctor.patient.index', $data);
    }

    public function chart()
    {
        return
            response()->json(Patient::selectRaw("COUNT(*) views, DATE_FORMAT(created_at, '%Y %m %e') date")
                ->groupBy('date')
                ->get());
    }

    public function graph()
    {
        $data['title'] = 'Patients Graph';
        return view('doctor.patient.graph', $data);
    }
}
