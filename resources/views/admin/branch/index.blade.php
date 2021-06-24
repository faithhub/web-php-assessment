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
          <li class="active">All Branches</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">All Branches</strong>
          </div>
          <div class="card-body">
            <div class="text-right">
              <a href="{{ route('admin-add-branch') }}" class="btn btn-dark mb-2">Add Branch</a>
            </div>
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Name</th>
                  <th>Amount Per Patient</th>
                  <th>Status</th>
                  <th>Added On</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($branches as $branch)
                <tr>
                  <td>{{$sn++}}</td>
                  <td>{{$branch->name}}</td>
                  <td>{{$branch->amount_per_patient}}</td>
                  <td>
                    @if($branch->status == 'Active')
                    <span class="badge badge-success">{{ $branch->status}}</span>
                    @else
                    <span class="badge badge-danger">{{ $branch->status}}</span>
                    @endif
                  </td>
                  <td>{{ date('D, M j, Y \a\t g:ia', strtotime($branch->created_at))}}</td>
                  <td>
                    @if($branch->status == 'Active')
                    <a href="{{ route('admin-edit-branch', $branch->id) }}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="{{ route('admin-delete-branch', $branch->id) }}" onclick="return confirm('Are you sure you want to make this Branch inactive?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Inactive</button>
                      @else
                      <a href="{{ route('admin-edit-branch', $branch->id) }}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Edit</a>
                      <button disabled class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Inactive</button>
                      @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .animated -->
</div>
@endsection