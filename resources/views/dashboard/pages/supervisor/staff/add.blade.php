@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <h4 class="card-title">Add New Member</h4>
                    </div>
                    <div class="card-content">
                        @include('dashboard.includes.errors')
                       
                        <div class="container">
                            <form action="{{ Route('staff.store') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" name="email" id="email" class="form-control"  placeholder="Enter member email" required>
                                </div>
                                <div class="form-group">
                                  <label for="name">Member Name</label>
                                  <input type="text" name="name" id="name" class="form-control"  placeholder="Enter member name" required>
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">Member Role</label>
                                  <select class="form-control" name="role_id" id="exampleFormControlSelect1">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="country_id">Member Country ID</label>
                                  <input type="text" name="country_id" id="country_id" class="form-control"  placeholder="Enter member country ID" required>
                                </div>
                                <div class="form-group">
                                  <label for="phone_number">Member Phone Number</label>
                                  <input type="text" name="phone_number" id="phone_number" class="form-control"  placeholder="Enter member phone number" required>
                                </div>
                                <div class="form-group">
                                  <label for="image">Member Image</label>
                                  <input type="file" class="form-control-file" name="image" id="image">
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