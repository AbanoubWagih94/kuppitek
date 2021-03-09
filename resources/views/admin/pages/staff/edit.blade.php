@extends('admin.app')

@section('admin.content')
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
                        <h4 class="card-title">تعديل البيانات</h4>
                    </div>
                    <div class="card-content">
                        @include('admin.includes.errors')
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                {{ session()->forget('error') }}
                            </div>
                        @endif
                        <div class="container">
                            <form action="{{ Route('staff.update', $user->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="form-group">
                                  <label for="userName">أسم المستخدم</label>
                                  <input type="text" name="user_name" value="{{ $user->user_name }}" id="userName" class="form-control"  placeholder="abanoub" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="name">أسم الموظف</label>
                                  <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control"  placeholder="أبانوب وجية">
                                </div>
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">اختر دور الموظف</label>
                                  <select class="form-control" name="role_id" id="exampleFormControlSelect1">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? "selected":""}}>{{ $role->title }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">تعديل</button>
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