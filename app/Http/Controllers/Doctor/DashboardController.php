<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('doctor');
    }

    public function index()
    {
        $data['title'] = 'Doctor Dashboard';
        $data['sn'] = 1;
        $data['patients'] = Patient::all()->count();
        return view('doctor.dashboard.index', $data);
    }
}
