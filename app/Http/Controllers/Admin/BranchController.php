<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->create_branch = new Branch();
    }

    public function index()
    {
        try {
            $data['sn'] = 1;
            $data['title'] = 'Branches';
            $data['branches'] = Branch::orderBy('id', 'DESC')->get();
            return view('admin.branch.index', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function add_new(Request $request)
    {
        if ($_POST) {
            $rules = array(
                'name'               => ['required', 'max:255', 'unique:users'],
                'amount_per_patient' => ['required'],
            );
            $fieldNames = array(
                'name'                => 'Branch Name',
                'amount_per_patient'  => 'Amount Per Patient',
            );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);
            if ($validator->fails()) {
                Session::flash('warning', 'Please check the form again!');
                return back()->withErrors($validator)->withInput();
            } else {
                try {
                    $this->create_branch->create_new($request);
                    Session::flash('success', 'New Branch Added Successfully');
                    return \redirect()->route('admin-branches');
                } catch (\Throwable $th) {
                    Session::flash('error', $th->getMessage());
                    return \back();
                }
            }
        } else {
            try {
                $data['title'] = 'Add New Branch';
                return view('admin.branch.create', $data);
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function edit_detail($id)
    {
        try {
            $data['title'] = 'Edit Branch';
            $data['branch'] = Branch::find($id);
            return view('admin.branch.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }

    public function edit(Request $request)
    {
        $rules = array(
            'name'               => ['required', 'max:255', 'unique:branches,name,' . $request->id],
            'amount_per_patient' => ['required'],
        );
        $fieldNames = array(
            'name'                => 'Branch Name',
            'amount_per_patient'  => 'Amount Per Patient',
        );
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);
        if ($validator->fails()) {
            Session::flash('warning', 'Please check the form again!');
            return back()->withErrors($validator)->withInput();
        } else {
            try {
                $branch                      = Branch::find($request->id);
                $branch->name                = $request->name;
                $branch->amount_per_patient  = $request->amount_per_patient;
                $branch->status              = $request->status;
                $branch->save();
                Session::flash('success', 'Branch Updated Successfully');
                return redirect()->route('admin-branches');
            } catch (\Throwable $th) {
                Session::flash('error', $th->getMessage());
                return \back();
            }
        }
    }

    public function delete($id)
    {
        try {
            $branch         = Branch::find($id);
            $branch->status = 'Inactive';
            $branch->save();
            Session::flash('success', 'Branch Status Change to Inactive Successfully');
            return redirect()->route('admin-branches');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return \back();
        }
    }
}
