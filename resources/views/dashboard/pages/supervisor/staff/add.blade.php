@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">أضافة موظف جديد</h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Member</h4>
                    </div>
                    <div class="card-content">
                        @include('dashboard.includes.errors')
                       
                        <div class="container">
                            <form action="{{ Route('staff.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                  <label for="userName">User Name</label>
                                  <input type="text" name="user_name" id="userName" class="form-control"  placeholder="abanoub">
                                </div>
                                <div class="form-group">
                                  <label for="name">Member Name</label>
                                  <input type="text" name="name" id="name" class="form-control"  placeholder="Abanoub Wagih">
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">Member Role</label>
                                  <select class="form-control" name="role_id" id="exampleFormControlSelect1">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                
                                <div class="form-group d-flex">
                                <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection