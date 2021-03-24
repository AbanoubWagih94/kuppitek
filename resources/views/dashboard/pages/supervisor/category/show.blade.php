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
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-de mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Products</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td> {{$category->title}}</td>
                                <td rowspan="2">
                                    @forelse ( $category->products as $product)
                                         <ul>
                                            <li>{{ $product->title }}</li>
                                         </ul>
                                    @empty
                                        No products Found
                                    @endforelse
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