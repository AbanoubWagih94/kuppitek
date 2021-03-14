@extends('dashboard.layouts.app')
@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> الطلبات الحالية</h3>
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
                                        <th></th>
                                        <th>Table Number</th>
                                        <th>Order Status</th>
                                        <th>Order Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $key => $order)
                                    
                                    @if($order->order_status < 4)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>ِ{{ $order->table->table_number }}</td>
                                        @if( $order->order_status == 1)
                                            <td>Order Not Served</td>
                                        @elseif($order->order_status == 2)
                                        <td>Order In Kitchen</td>    
                                        @elseif($order->order_status == 3)
                                        <td>Order Is Ready</td>    
                                        @elseif($order->order_status == 4)
                                        <td>Order On Table Now</td>    
                                        @endif
                                        <td>
                                            <a href="{{ route('waiter.show', $order->id) }}" class="btn btn-sm round btn-outline-info">Order Details</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('waiter.destroy', $order->id) }}" class="btn btn-sm round btn-outline-danger" onclick="return confirm('Do you want to remove this order?!')">Remove</a>
                                        </td>
                                    </tr>
                                    @endif
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