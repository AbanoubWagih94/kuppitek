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
                            @include('dashboard.includes.errors')
                            <table class="table table-de mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Table Number</th>
                                        <th>Table Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $key => $order)
                                    
                                    @if($order->order_status < 5)
                                    <tr>
                                        <td>{{ $order->id }}</td>
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
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm round btn-warning"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm round btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-danger" onclick="return confirm('Do you want to remove this order?!')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                        
                                    </tr> 
                                    @endif
                                    @empty
                                        <td colspan="3">No Orders Found</td>
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