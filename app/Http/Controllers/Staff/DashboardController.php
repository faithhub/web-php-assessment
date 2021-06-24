<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
    }

    public function index()
    {
        $data['title'] = 'Staff Dashboard';
        $data['sn'] = 1;
        $data['patients'] = Patient::all()->count();
        return view('staff.dashboard.index', $data);
    }
}
