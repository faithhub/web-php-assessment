<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
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
            $data['title'] = 'Doctors';
            $data['doctors'] = User::where('role', 'Doctor')->with('speciality:*')->orderBy('id', 'DESC')->get();
            return view('admin.doctors.index', $data);
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
                'speciality_id' => ['required'],
            );
            $fieldNames = array(
                'name'           => 'Full Name',
                'username'       => 'Username',
                'email'          => 'Email',
                'phone_number'   => 'Phone Number',
                'gender'         => 'Gender',
                'speciality_id'  => 'Speciality',
            );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails()) {
                Session::flash('warning', 'Please check the form again!');
                return back()->withErrors($validator)->withInput();
            } else {
                $this->create_user->create_doctor($request);
                Session::flash('success', 'New Doctor Added Successfully');
                return \redirect()->route('admin-doctors');
            }
        } else {
            try {
                $data['title'] = 'Add New Doctor';
                $data['specialities'] = Speciality::orderBy('name', 'ASC')->get();
                return view('admin.doctors.create', $data);
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function view($id)
    {
        try {
            $data['title'] = 'Edit Doctors';
            $data['specialities'] = Speciality::orderBy('name', 'ASC')->get();
            $data['doctor'] = User::where('role', 'Doctor')->where('id', $id)->with('speciality:*')->first();
            return view('admin.doctors.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function view_details($id)
    {
        try {
            $data['doctor'] = $doctor = User::where('role', 'Doctor')->where('id', $id)->with('speciality:*')->first();
            $data['title'] = $doctor->name . ' Details';
            return view('admin.doctors.view', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function edit(Request $request)
    {
        $rules = array(
            'name'           => ['required', 'max:255'],
            'email'          => ['required', 'max:255', 'unique:users,email,' . $request->id],
            'phone_number'   => ['required', 'max:255', 'unique:users,phone_number,' . $request->id],
            'gender'         => ['required'],
            'speciality_id'  => ['required'],
            'status'         => ['required'],
        );
        $fieldNames = array(
            'name'           => 'Full Name',
            'email'          => 'Email',
            'phone_number'   => 'Phone Number',
            'gender'         => 'Gender',
            'speciality_id'  => 'Speciality',
            'status'         => 'Account Status',
        );
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            Session::flash('warning', 'Please check the form again!');
            return back()->withErrors($validator)->withInput();
        } else {
            try {
                $user                = User::where('role', 'Doctor')->where('id', $request->id)->first();
                $user->name          = $request->name;
                $user->email         = $request->email;
                $user->phone_number  = $request->phone_number;
                $user->gender        = $request->gender;
                $user->speciality_id = $request->speciality_id;
                $user->status        = $request->status;
                $user->save();
                Session::flash('success', 'Doctor Updated Successfully');
                return redirect()->route('admin-doctors');
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function delete($id)
    {
        try {
            $user = User::where('role', 'Doctor')->where('id', $id)->first();
            $user->delete();
            Session::flash('success', 'Doctor Deleted Successfully');
            return redirect()->route('admin-doctors');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return redirect()->route('admin-doctors');
        }
    }
}
