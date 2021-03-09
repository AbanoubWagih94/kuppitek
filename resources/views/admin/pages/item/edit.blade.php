@extends('admin.app')

@section('admin.content')
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
                        <h4 class="card-title">قسم منيو</h4>
                    </div>
                    <div class="card-content">
                  
                        <div class="container">
                            <form action="{{ Route('menuitem.update',$menu->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('put')
                                @include('admin.includes.errors')
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">اختر  قسم</label>
                                    <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                                      @foreach($MenuCategories as $cat)
                                      <option value="{{ $cat->id }}"  
                                        @if($cat->id == $menu->category_id) selected @endif
                                        >{{ $cat->title }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                <div class="form-group">
                                  <label for="name">أسم المنيو</label>
                                  <input type="text" name="name" id="name" class="form-control"  placeholder=" اكتب اسم المنيو" value="{{$menu->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="name"> التكلفه</label>
                                    <input type="text" name="cost" id="cost" class="form-control"  placeholder="   ادخل التكلفه"   value="{{$menu->cost}}">
                                  </div>
                               
                                <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">حفظ</button>
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