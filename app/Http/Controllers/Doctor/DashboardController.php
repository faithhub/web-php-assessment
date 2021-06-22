<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
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
        return view('doctor.dashboard.index', $data);
    }
}
