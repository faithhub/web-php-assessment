<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $data['sn'] = 1;
        $data['admin'] = User::where('role', 'Admin')->where('status', 'Active')->count();
        $data['doctor'] = User::where('role', 'Doctor')->where('status', 'Active')->count();
        $data['staff'] = User::where('role', 'Staff')->where('status', 'Active')->count();
        $data['branch'] = Branch::where('status', 'Active')->count();
        return view('admin.dashboard.index', $data);
    }
}
