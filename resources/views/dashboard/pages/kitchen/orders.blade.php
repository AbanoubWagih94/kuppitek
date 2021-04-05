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
                                            <th>#</th>
                                            <th>Table Number</th>
                                            <th>Waiter Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody  class="text-center">
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>ِ {{ $order->table->table_number }}</td>
                                                <td>ِ {{ $order->waiter->name }}</td>
                                                <td>   
                                                @if ($order->order_status == 2)
                                                <a class='btn btn-sm round btn-success'
                                                href="{{ route('kitchen.accept', $order->id) }}"
                                                onclick="return confirm(' Do you want to accept this order?!')"><i class="fas fa-check-square"></i></a>
                                                @else
                                                    
                                                <a href="{{ route('kitchen.show', $order->id) }}"
                                                    class='btn btn-sm round btn-warning'><i class='fas fa-eye'></i></a>
                                                    
                                                @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5"> No Orders Found </td>
                                            </tr>
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