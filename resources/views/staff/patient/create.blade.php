@extends('staff.layouts.app')
@section('staff')

<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">
      <div class="page-title">
        <h1>Dashboard</h1>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="page-header float-right">
      <div class="page-title">
        <ol class="breadcrumb text-right">
          <li class="active"> @isset($patient) Edit Patient @else Add New Patient @endisset</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong> @isset($patient) Edit {{$patient->name}} Patient @else Add New Patient @endisset</strong>
        </div>
        <div class="card-body card-block">
          <form method="post" action="{{ route('staff-add-patient') }}">
            @csrf
            @isset($patient) <input type="hidden" name="id" value="{{ $patient->id }}"> @endisset
            <div class="form-group">
              <label class=" form-control-label">Name</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input class="form-control" name="name" @isset($patient->name) value="{{ $patient->name }}" @else value="{{ old('name') }}" @endisset>
              </div>
              @error('name')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Phone Number</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                <input class="form-control" @isset($patient->phone_number) value="{{ $patient->phone_number }}" @else value="{{ old('phone_number') }}" @endisset name="phone_number" type="number">
              </div>
              @error('phone_number')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Address</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-address-book"></i></div>
                <textarea class="form-control" name="address">@isset($patient->address){{ $patient->address }}@else{{ old('address') }}@endisset</textarea>
              </div>
              @error('address')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Date of Birth</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-address-book"></i></div>
                <input class="form-control" @isset($patient->date_of_birth) value="{{ $patient->date_of_birth }}" @else value="{{ old('date_of_birth') }}" @endisset name="date_of_birth" type="date">
              </div>
              @error('date_of_birth')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Gender</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-male"></i></div>
                <select class="form-control" name="gender">
                  <option value="">Select Gender</option>
                  <option value="Male" @isset($patient) {{ $patient->gender == "Male" ? "selected" : "" }} @else {{ old("gender") == "Male" ? "selected" : "" }} @endisset>Male</option>
                  <option value="Female" @isset($patient) {{ $patient->gender == "Female" ? "selected" : "" }} @else {{ old("gender") == "Female" ? "selected" : "" }} @endisset>Female</option>
                </select>
              </div>
              @error('gender')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="text-right">
              <button class="btn btn-success">@isset($patient) Update @else Create @endisset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div> <!-- .content -->
@endsection