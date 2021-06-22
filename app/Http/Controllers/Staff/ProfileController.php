<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
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
            $data['title'] = 'Staff Profile';
            return view('staff.settings.index', $data);
        }
    }
}
