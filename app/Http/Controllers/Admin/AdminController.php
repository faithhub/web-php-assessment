<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_user = new User();
    }

    public function index()
    {
        try {
            $data['sn'] = 1;
            $data['title'] = 'Admins';
            $data['admins'] = User::where('role', 'Admin')->orderBy('id', 'DESC')->get();
            return view('admin.admins.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
    public function add_new(Request $request)
    {
        if ($_POST) {
            $rules = array(
                'name'          => ['required', 'max:255'],
                'username'      => ['required', 'max:255', 'unique:users'],
                'email'         => ['required', 'max:255', 'unique:users'],
                'phone_number'  => ['required', 'max:255', 'unique:users'],
                'gender'        => ['required'],
            );
            $fieldNames = array(
                'name'           => 'Full Name',
                'username'       => 'Username',
                'email'          => 'Email',
                'phone_number'   => 'Phone Number',
                'gender'         => 'Gender',
            );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails()) {
                Session::flash('warning', 'Please check the form again!');
                return back()->withErrors($validator)->withInput();
            } else {
                $this->create_user->create_admin($request);
                Session::flash('success', 'New Admin Added Successfully');
                return \redirect()->route('admin-admins');
            }
        } else {
            try {
                $data['title'] = 'Add New Admin';
                return view('admin.admins.create', $data);
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function view($id)
    {
        try {
            $data['title'] = 'Edit Admin';
            $data['admin'] = User::where('role', 'Admin')->where('id', $id)->first();
            return view('admin.admins.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function view_details($id)
    {
        try {
            $data['admin'] = $doctor = User::where('role', 'Admin')->where('id', $id)->first();
            $data['title'] = $doctor->name . ' Details';
            return view('admin.admins.view', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function edit(Request $request)
    {
        $rules = array(
            'name'         => ['required', 'max:255'],
            'email'        => ['required', 'max:255', 'unique:users,email,' . $request->id],
            'phone_number' => ['required', 'max:255', 'unique:users,phone_number,' . $request->id],
            'gender'       => ['required'],
            'status'       => ['required'],
        );
        $fieldNames = array(
            'name'           => 'Full Name',
            'email'          => 'Email',
            'phone_number'   => 'Phone Number',
            'gender'         => 'Gender',
            'status'         => 'Account Status',
        );
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            Session::flash('warning', 'Please check the form again!');
            return back()->withErrors($validator)->withInput();
        } else {
            try {
                $user                = User::where('role', 'Admin')->where('id', $request->id)->first();
                $user->name          = $request->name;
                $user->email         = $request->email;
                $user->phone_number  = $request->phone_number;
                $user->gender        = $request->gender;
                $user->status        = $request->status;
                $user->save();
                Session::flash('success', 'Admin Updated Successfully');
                return redirect()->route('admin-admins');
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function delete($id)
    {
        try {
            $user = User::where('role', 'Admin')->where('id', $id)->first();
            $user->delete();
            Session::flash('success', 'Admin Deleted Successfully');
            return redirect()->route('admin-admins');
            return \back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect()->route('admin-admins');
        }
    }
}
