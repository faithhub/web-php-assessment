<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
        $this->patient = new Patient();
    }

    public function index()
    {
        $data['title'] = 'All Patients';
        $data['sn'] = 1;
        $data['date'] = Carbon::now();
        $data['patients'] = Patient::orderBy('id', 'DESC')->get();
        return view('staff.patient.index', $data);
    }

<<<<<<< HEAD
    public function add_new(Request $request)
    {
        if ($_POST) {
            $rules = array(
                'name'          => ['required', 'max:255'],
                'phone_number'  => ['required', 'max:255', 'unique:patients'],
                'date_of_birth' => ['required'],
                'address'       => ['required'],
                'gender'        => ['required']
            );

            $fieldNames = array(
                'name'           => 'Full Name',
                'phone_number'   => 'Phone Number',
                'date_of_birth'  => 'Date of Birth',
                'Address'        => 'Address',
                'gender'         => 'Gender'
            );
=======
  public function add_new(Request $request)
  {
    if ($_POST) {
      $rules = array(
          'name'          => ['required', 'max:255'],
          'phone_number'  => ['required', 'max:255', 'unique:patients'],
          'address'  => ['required', 'max:255',],
          'date_of_birth'  => ['required'],
          'gender'        => ['required']
      );

      $fieldNames = array(
          'name'           => 'Full Name',
          'phone_number'   => 'Phone Number',
          'address'  => 'Address',
          'date_of_birth'   => 'Date of Birth',
          'gender'         => 'Gender'
      );
>>>>>>> 0bfaffa2ed9939fc1ef06779b9f071feafc44edf

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

<<<<<<< HEAD
            if ($validator->fails()) {
                Session::flash('warning', 'Please check the form again!');
                return back()->withErrors($validator)->withInput();
            } else {
                $this->patient->create($request);
                Session::flash('success', 'New Patient Added Successfully');
                return \redirect()->route('patients');
            }
        } else {
            try {
                $data['title'] = 'Add New Patient';
                return view('staff.patient.create', $data);
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }
=======
      if ($validator->fails()) {
          Session::flash('warning', 'Please check the form again!');
          return back()->withErrors($validator)->withInput();
      } else {
          $this->patient->create($request);
          Session::flash('success', 'New Patient Added Successfully');
          return \redirect()->route('patients');
      }
  } else {
      try {
          $data['title'] = 'Add New Patient';
          return view('staff.dashboard.patient.create', $data);
      } catch (\Throwable $th) {
          Session::flash('error', $th->getMessage());
          return \back();
      }
  }
  }
>>>>>>> 0bfaffa2ed9939fc1ef06779b9f071feafc44edf
}
