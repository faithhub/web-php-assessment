<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
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
        return view('doctor.patient.index', $data);
    }

}
