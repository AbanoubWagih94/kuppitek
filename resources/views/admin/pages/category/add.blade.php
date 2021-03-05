@extends('admin.app')

@section('admin.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">أضافة قسم جديد</h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">قسم جديد</h4>
                    </div>
                    <div class="card-content">
                  
                        <div class="container">
                            <form action="{{ Route('category.store') }}" method="POST">
                                {{ csrf_field() }}
                                @include('admin.includes.errors')
                            
                                <div class="form-group">
                                  <label for="name">أسم القسم</label>
                                  <input type="text" name="name" id="name" class="form-control"  placeholder=" اكتب اسم القسم">
                                </div>
                               
                                <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">أضافة</button>
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