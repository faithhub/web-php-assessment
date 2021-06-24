<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
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

    public function index()
    {
        try {
            $data['sn'] = 1;
            $data['title'] = 'Staffs';
            $data['staffs'] = User::where('role', 'Staff')->orderBy('id', 'DESC')->get();
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
                'branch_id'    => ['required', 'max:255'],
                'name'         => ['required', 'max:255'],
                'username'     => ['required', 'max:255', 'unique:users'],
                'email'        => ['required', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'max:255', 'unique:users'],
                'gender'       => ['required'],
            );
            $fieldNames = array(
                'branch_id'      => 'Branch Name',
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
                $data['branches'] = Branch::where('status', 'Active')->orderBy('id', 'DESC')->get();
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
            $data['branches'] = Branch::where('status', 'Active')->orderBy('id', 'DESC')->get();
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
            'branch_id'     => ['required', 'max:255'],
            'name'          => ['required', 'max:255'],
            'email'         => ['required', 'max:255', 'unique:users,email,' . $request->id],
            'phone_number'  => ['required', 'max:255', 'unique:users,phone_number,' . $request->id],
            'gender'        => ['required'],
            'status'        => ['required'],
        );
        $fieldNames = array(
            'branch_id'      => 'Branch Name',
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
                $user                = User::where('role', 'Staff')->where('id', $request->id)->first();
                $user->branch_id     = $request->branch_id;
                $user->name          = $request->name;
                $user->email         = $request->email;
                $user->phone_number  = $request->phone_number;
                $user->gender        = $request->gender;
                $user->status        = $request->status;
                $user->save();
                Session::flash('success', 'Staff Updated Successfully');
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
            $user         = User::where('role', 'Staff')->where('id', $id)->first();
            $user->status = 'Deleted';
            $user->save();
            Session::flash('success', 'Staff Deleted Successfully');
            return redirect()->route('admin-staffs');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}
