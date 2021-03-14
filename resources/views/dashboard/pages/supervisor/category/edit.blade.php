@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">تعديل قسم </h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Edit Category </h4>
                    </div>
                    <div class="card-content">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                {{ session()->forget('error') }}
                            </div>
                        @endif
                        <div class="container">
                            <form action="{{ Route('category.update',$cat->id) }}" method="POST">
                                {{ csrf_field() }}
                            @method('put')
                            @include('dashboard.includes.errors')

                                <div class="form-group">
                                  <label for="name">Category Title</label>
                                  <input type="text" name="name" id="name" class="form-control"  placeholder=" اكتب اسم القسم" value="{{$cat->title}}" >
                                </div>
                               
                                <div class="form-group d-flex justify-content-end">
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