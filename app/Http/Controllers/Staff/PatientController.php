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

    public function view($id)
    {
        try {
            $data['title'] = 'Edit Staff';
            $data['patient'] = Patient::find($id);
            return view('staff.patient.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function view_details($id)
    {
        try {
            $data['patient'] = $patient = Patient::find($id);
            $data['title'] = $patient->name . ' Details';
            return view('staff.patient.view', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function add_new(Request $request)
    {
        if ($_POST) {
            if ($request->id) {
                $rules = array(
                    'name'          => ['required', 'max:255'],
                    'phone_number'  => ['required', 'max:255', 'unique:patients,phone_number,' . $request->id],
                    'date_of_birth' => ['required'],
                    'address'       => ['required'],
                    'gender'        => ['required']
                );

                $fieldNames = array(
                    'name'           => 'Full Name',
                    'phone_number'   => 'Phone Number',
                    'date_of_birth'  => 'Date of Birth',
                    'address'        => 'Address',
                    'gender'         => 'Gender'
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $patient                = Patient::find($request->id);
                        $patient->name          = $request->name;
                        $patient->phone_number  = $request->phone_number;
                        $patient->date_of_birth = $request->date_of_birth;
                        $patient->address       = $request->address;
                        $patient->gender        = $request->gender;
                        $patient->save();
                        Session::flash('success', 'New Patient Added Successfully');
                        return \redirect()->route('patients');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
            } else {
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

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('warning', 'Please check the form again!');
                    return back()->withErrors($validator)->withInput();
                } else {
                    try {
                        $this->patient->create($request);
                        Session::flash('success', 'New Patient Added Successfully');
                        return \redirect()->route('patients');
                    } catch (\Throwable $th) {
                        Session::flash('error', $th->getMessage());
                        return \back();
                    }
                }
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

    public function delete($id)
    {
        try {
            $patient = Patient::find($id);
            $patient->delete();
            Session::flash('success', 'Patient Deleted Successfully');
            return redirect()->route('patients');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}
