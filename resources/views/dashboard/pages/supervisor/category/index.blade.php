@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> اقسام kuppitek</h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('category.create') }}" class="btn btn-md round btn-outline-primary">Add Category</a>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-de mb-0">
                            @include('dashboard.includes.errors')
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($MenuCategories as $cat)
                                <tr>
                                <td>{{$cat->id}} </td>
                                <td> {{$cat->title}}</td>
                                <td>
                                            <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-sm round btn-outline-info">Edit</a>
                                        
                                        <form action="{{ route('category.destroy', $cat->id) }}" method="post" class="btn-group">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-outline-danger" onclick="return confirm('هل انت متاكد من حذف هذا القسم')">Remove</button>
                                            </form>
                                        </td>
                                        </tr>
                                    @endforeach
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