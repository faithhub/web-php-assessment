<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

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
}
