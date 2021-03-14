@extends('dashboard.layouts.app')

@section('dashboard.content')
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
                        <a href="{{ route('menuitem.create') }}" class="btn btn-md round btn-outline-primary float-right">Add New Item</a>
                        
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                          
                            <table class="table table-de mb-0">
                            @include('dashboard.includes.errors')

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Cost</th>
                                        <th>Control</th>
                                        
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
                                            <a href="{{ route('menuitem.edit', $menu->id) }}" class="btn btn-sm round btn-outline-info">Edit</a>
                                        
                                        <form action="{{ route('menuitem.destroy', $menu->id) }}" method="post" class="btn-group">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-outline-danger" onclick="return confirm('Do you want to remove this item?!')">Remove</button>
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