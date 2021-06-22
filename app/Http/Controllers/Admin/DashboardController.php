<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }

    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $data['sn'] = 1;
        return view('admin.dashboard.index', $data);
    }
}
