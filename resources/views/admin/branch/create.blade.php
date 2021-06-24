@extends('admin.layouts.app')
@section('admin')

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
          <li class="active"> @isset($branch) Edit branch @else Add New branch @endisset</li>
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
          <strong> @isset($branch) Edit {{$branch->name}} branch @else Add New branch @endisset</strong>
        </div>
        <div class="card-body card-block">
          <form method="post" action="@isset($branch) {{ route('admin-edit') }}  @else {{ route('admin-add-branch') }} @endisset">
            @csrf
            @isset($branch->name) <input type="hidden" name="id" value="{{ $branch->id }}"> @endisset
            <div class="form-group">
              <label class=" form-control-label">Name</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input class="form-control" name="name" @isset($branch->name) value="{{ $branch->name }}" @else value="{{ old('name') }}" @endisset>
              </div>
              @error('name')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label class=" form-control-label">Amount Per Patient</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-edit"></i></div>
                <input class="form-control" name="amount_per_patient" type="number" @isset($branch->amount_per_patient) value="{{ $branch->amount_per_patient }}" @else value="{{ old('amount_per_patient') }}" @endisset>
              </div>
              @error('amount_per_patient')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            @isset($branch->status)
            <div class="form-group">
              <label class=" form-control-label">Account Status</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <select class="form-control" name="status">
                  <option value="">Select Status</option>
                  <option value="Active" @isset($branch) {{ $branch->status == "Active" ? "selected" : "" }} @else {{ old("status") == "Active" ? "selected" : "" }} @endisset>Active</option>
                  <option value="Inactive" @isset($branch) {{ $branch->status == "Inactive" ? "selected" : "" }} @else {{ old("status") == "Inactive" ? "selected" : "" }} @endisset>Inactive</option>
                </select>
              </div>
              @error('status')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            @endisset
            <div class="text-right">
              <button class="btn btn-success">@isset($branch) Update @else Create @endisset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div> <!-- .content -->
@endsection