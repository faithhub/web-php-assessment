<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('doctor');
    }

    public function index(Request $request)
    {
        if($_POST){
            $rules = array(
                'name' => ['required', 'max:255'],
                'email' => ['required', 'max:255', 'unique:users,email,'.Auth::user()->id],
                'phone_number' => ['required', 'max:255', 'unique:users,phone_number,'.Auth::user()->id],
                'avatar' => 'image|mimes:jpg,jpeg,png|max:5000',
            );
            $fieldNames = array(
                'name'     => 'Full Name',
                'email'     => 'Email',
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
        }else{
            $data['title'] = 'Doctor Profile';
            return view('doctor.settings.index', $data);
        }
    }

    public function change(Request $request)
    {
       if($_POST){
        $rules = array(
            'old_password'     => 'required',
            'new_password'  => ['required', 'min:8', 'max:16', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&+-]/'],
            'confirm_new_password' => 'required'
        );

        $fieldNames = array(
            'old_password'     => 'Current Password',
            'new_password'  => 'New Password',
            'confirm_new_password' => 'Confirm New Password'
        );
        //dd($request);
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            $request->session()->flash('warning', 'Password must 8 character long, maximum of 16 character, One English uppercase characters (A – Z), One English lowercase characters (a – z), One Base 10 digits (0 – 9) and One Non-alphanumeric (For example: !, $, #, or %)');
            return back()->withErrors($validator);
        } else {
            $current_password = Auth::user()->password;
            if (Hash::check($request->old_password, $current_password)) {
                if ($request->new_password == $request->confirm_new_password) {
                    $user_id = Auth::user()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request->new_password);
                    $obj_user->save();
                    $request->session()->flash('success', 'Password changed successfully');
                    return \back();
                } else {
                    $request->session()->flash('warning', 'Password not set');
                    return back()->withErrors(['new_password' => 'The New password and Confirm password not match']);
                }
            } else {
                $request->session()->flash('warning', 'Password Wrong');
                return back()->withErrors(['old_password' => 'Please enter correct current password']);
            }
        }
       }else{           
        $data['title'] = 'Change Password';
        return view('doctor.settings.change-password', $data);
       }
    }
}
