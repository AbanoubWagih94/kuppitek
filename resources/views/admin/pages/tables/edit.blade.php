@extends('admin.app')

@section('admin.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">تعديل بيانات طاولة رقم {{ $table->table_number }}</h3>
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
                            <form action="{{ Route('table.update', $table->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="form-group">
                                    <label for="tableNumber">رقم الطاولة</label>
                                    <input type="text" name="table_number" value="{{ $table->table_number }}" id="tableNumber" class="form-control"  placeholder="4" disabled>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlSelect1">اختر الموظفين المسئولين عن الطاولة</label>
                                    <select class="form-control"  name="users[]" id="exampleFormControlSelect1" multiple="multiple">
                                      @forelse($users as $user)
                                       <option value="{{ $user->id }}" {{ in_array($user->id, $users_ids)? "selected" : ""}}>{{ $user->name }}</option>
                                      @empty
                                          <option>لم تقم بأضافة اى نادل حتى الان</option>
                                      @endforelse
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