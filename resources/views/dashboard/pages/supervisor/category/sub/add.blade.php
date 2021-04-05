@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"></h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <h4 class="card-title">Add New Sub Category</h4>
                    </div>
                    <div class="card-content">
                  
                        <div class="container">
                            <form action="{{ Route('sub.store') }}" method="POST">
                                {{ csrf_field() }}
                                @include('dashboard.includes.errors')
                            
                                <div class="form-group">
                                  <label for="name">Sub Category Title</label>
                                  <input type="text" name="title" id="name" class="form-control"  placeholder="Enter Sub Category title">
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="category_id" id="category">
                                      @foreach($categories as $cat)
                                      <option value="{{ $cat->id }}">{{ $cat->title }}</option>
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