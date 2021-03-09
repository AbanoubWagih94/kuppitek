@extends('admin.app')

@section('admin.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> منيو kuppitek</h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('menuitem.create') }}" class="btn btn-md round btn-outline-primary float-right">أضافة منيو</a>
                        <h4 class="card-title"> عناصر المنيو</h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                          
                            <table class="table table-de mb-0">
                            @include('admin.includes.errors')

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>title</th>
                                        <th>category</th>
                                        <th>cost</th>
                                        <th>control</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($MenuItems)
                                @foreach($MenuItems as $menu)
                                <tr>
                                <td>{{$menu->id}} </td>
                                <td> {{$menu->title}}</td>
                                <td> {{$menu->category->title}}</td>
                                <td> {{$menu->cost}}</td>
                                <td>
                                            <a href="{{ route('menuitem.edit', $menu->id) }}" class="btn btn-sm round btn-outline-info">تعديل</a>
                                        
                                        <form action="{{ route('menuitem.destroy', $menu->id) }}" method="post" class="btn-group">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-outline-danger" onclick="return confirm('هل انت متاكد من حذف هذا المنيو')">حذف</button>
                                            </form>
                                        </td>
                                        </tr>
                                    @endforeach
                                    @else 
                                    <td> لايوجد معلومات</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection