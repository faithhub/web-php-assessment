<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_user = new User();
    }

    public function index(Request $request)
    {
        try {
            $data['sn'] = 1;
            $data['title'] = 'Staffs';
            $data['staffs'] = User::where('role', 'Staff')->orderBy('id', 'ASC')->get();
            return view('admin.staffs.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
    
    public function add_new(Request $request)
    {
        if ($_POST) {
            $rules = array(
                'name'         => ['required', 'max:255'],
                'username'     => ['required', 'max:255', 'unique:users'],
                'email'        => ['required', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'max:255', 'unique:users'],
                'gender'       => ['required'],
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
                try {
                    $this->create_user->create_staff($request);
                    Session::flash('success', 'New Staff Added Successfully');
                    return \redirect()->route('admin-staffs');
                } catch (\Throwable $th) {
                    Session::flash('error', $th->getMessage());
                    return \back();
                }
            }
        } else {
            try {
                $data['title'] = 'Add New Staff';
                return view('admin.staffs.create', $data);
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function view($id)
    {
        try {
            $data['title'] = 'Edit Staff';
            $data['staff'] = User::where('role', 'Staff')->where('id', $id)->first();
            return view('admin.staffs.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function view_details($id)
    {
        try {
            $data['staff'] = $staff = User::where('role', 'Staff')->where('id', $id)->first();
            $data['title'] = $staff->name . ' Details';
            return view('admin.staffs.view', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function edit(Request $request)
    {
        $rules = array(
            'name'          => ['required', 'max:255'],
            'email'         => ['required', 'max:255', 'unique:users,email,' . $request->id],
            'phone_number'  => ['required', 'max:255', 'unique:users,phone_number,' . $request->id],
            'gender'        => ['required'],
        );
        $fieldNames = array(
            'name'           => 'Full Name',
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
            try {
                $user                = User::where('role', 'Staff')->where('id', $request->id)->first();
                $user->name          = $request->name;
                $user->email         = $request->email;
                $user->phone_number  = $request->phone_number;
                $user->gender        = $request->gender;
                $user->speciality_id = $request->speciality_id;
                $user->save();
                Session::flash('success', 'Profile Updated Successfully');
                return redirect()->route('admin-staffs');
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function delete($id)
    {
        try {
            $user = User::where('role', 'Staff')->where('id', $id)->first();
            $user->delete();
            Session::flash('success', 'Staff Deleted Successfully');
            return redirect()->route('admin-staffs');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}
