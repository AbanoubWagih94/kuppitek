@extends('dashboard.layouts.app')
@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('products.create') }}" class="btn btn-md round btn-outline-primary">Add New Product</a>
                        
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>ِAction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $key => $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>ِ{{ $product->title }}</td>
                                        <td>{{ $product->category->title }}</td>
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm round btn-warning"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm round btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-danger" onclick="return confirm('Do you want to remove this product?!')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>    
                                    @empty
                                        <tr><td colspan="3">No Prodcuts Found</td></tr>
                                    @endforelse
                                    
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