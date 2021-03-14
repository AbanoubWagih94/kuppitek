@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">تعديل بيانات {{ $user->name }}</h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-content">
                        @include('dashboard.includes.errors')
                        <div class="container">
                            <form action="{{ Route('staff.update', $user->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="form-group">
                                  <label for="userName">User Name</label>
                                  <input type="text" name="user_name" value="{{ $user->user_name }}" id="userName" class="form-control"  placeholder="abanoub" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="name">Member Name</label>
                                  <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control"  placeholder="abanoub wagih">
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">Member Role</label>
                                  <select class="form-control" name="role_id" id="exampleFormControlSelect1">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? "selected":""}}>{{ $role->title }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group d-flex">
                                <button type="submit" class="btn btn-primary">Update</button>
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