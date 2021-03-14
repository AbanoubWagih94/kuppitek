@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">تعديل عنصر فى المنيو </h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-content">
                  
                        <div class="container">
                            <form action="{{ Route('menuitem.update',$menu->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('put')
                                @include('dashboard.includes.errors')
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Category</label>
                                    <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                                      @foreach($MenuCategories as $cat)
                                      <option value="{{ $cat->id }}"  
                                        @if($cat->id == $menu->category_id) selected @endif
                                        >{{ $cat->title }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                <div class="form-group">
                                  <label for="name">Item Title</label>
                                  <input type="text" name="name" id="name" class="form-control"  placeholder="Item Title" value="{{$menu->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="name"> Cost</label>
                                    <input type="text" name="cost" id="cost" class="form-control"  placeholder="Enter Item Cost"   value="{{$menu->cost}}">
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