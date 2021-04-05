@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> </h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-3">
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
                            <form action="{{ Route('sub.update',$sub->id) }}" method="POST">
                                {{ csrf_field() }}
                            @method('put')
                            @include('dashboard.includes.errors')

                            <div class="form-group">
                                <label for="name">Sub Category Title</label>
                                <input type="text" name="title" id="name" class="form-control" value="{{ $sub->title }}"  placeholder="Enter Sub Category title">
                              </div>
                              <div class="form-group">
                                  <label for="category">Category</label>
                                  <select class="form-control" name="category_id" id="category">
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $sub->category_id == $cat->id? 'selected':'' }}>{{ $cat->title }}</option>
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