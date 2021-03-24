@extends('dashboard.layouts.app')
@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">            
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Cost Price</th>
                                        <th>Selling Price</th>
                                        <th>Ingredients</th>
                                        <th>Product Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>ِ{{ $product->title }}</td>
                                        <td>ِ{{ $product->category->title }}</td>
                                        <td>{{ $product->quantity }}</td>   
                                        <td>ِ{{ $product->cost_price }}</td>
                                        <td>ِ{{ $product->selling_price }}</td>
                                        <td>
                                            <p>
                                                {{ $product->ingredients }}
                                            </p>
                                        </td>
                                        <td>ِ
                                            @if($product->image_path != "")
                                                <img src="{{ asset('assets/uploads/images/products/'.$product->image_path) }}" width="200" height="200" class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('assets/images/product.png')}}" width="200" height="200" class="img-thumbnail">
                                            @endif
                                        </td>
                                        
                                    </tr>
                                    
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