<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function index(Request $request)
    {
        $data['sn'] = 1;
        $data['title'] = 'Doctors';
        $data['doctors'] = User::where('role', 'Doctor')->with('speciality:*')->orderBy('id', 'ASC')->get();
        return view('admin.doctors.index', $data);
    }
    public function add_new(Request $request)
    {
        if ($_POST) {
            $rules = array(
                'name' => ['required', 'max:255'],
                'username' => ['required', 'max:255', 'unique:users'],
                'email' => ['required', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'max:255', 'unique:users'],
                'avatar' => 'image|mimes:jpg,jpeg,png|max:5000',
                'gender' => ['required'],
                'speciality_id' => ['required'],
            );
            $fieldNames = array(
                'name'     => 'Full Name',
                'email'     => 'Email',
                'phone_number'   => 'Phone Number',
                'avatar'   => 'Profile Picture',
                'gender'     => 'Gender',
                'speciality_id' => 'Speciality',
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
            $data['title'] = 'Add New Doctor';
            $data['specialities'] = Speciality::orderBy('name', 'ASC')->get();
            return view('admin.doctors.create', $data);
        }
    }

    public function edit(){
        
        $rules = array(
            'name' => ['required', 'max:255'],
            'password'  => ['required', 'min:8', 'max:16', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&+-]/'],
            'email' => ['required', 'max:255', 'unique:users,email,' . Auth::user()->id],
            'phone_number' => ['required', 'max:255', 'unique:users,phone_number,' . Auth::user()->id],
            'avatar' => 'image|mimes:jpg,jpeg,png|max:5000',
        );
        $fieldNames = array(
            'name'     => 'Full Name',
            'email'     => 'Email',
            'password'     => 'Password',
            'phone_number'   => 'Phone Number',
            'avatar'   => 'Profile Picture',
        );
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            Session::flash('warning', 'Please check the form again!');
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->file('avatar')) {
                $file = $request->file('avatar');
                $picture = 'STF' . date('dMY') . time() . '.' . $file->getClientOriginalExtension();
                $pictureDestination = 'uploads/admin_avatar';
                $file->move($pictureDestination, $picture);
            }
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->avatar = $request->hasFile('avatar') ? $picture : $user->avatar;
            $user->save();
            Session::flash('success', 'Profile Updated Successfully');
            return \back();
        }
    }
}
