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
                          @if ($order->order_status == 1)
                          <a href = "{{ route('waiter.add.kitchen', $order->id) }}" class="btn btn-md btn-primary">Add To Kitchen</a>
                          @endif
                          @if($order->counter_id == null)
                          <a href = "{{ route('waiter.show.cashier', $order->id) }}" class="btn btn-md btn-primary">Add To Cashier</a>  
                          @endif  
                            
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                @include('dashboard.includes.errors')
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th>Item Number</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Item Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($order->items as $item)
                                        <tr>
                                            <td>ِ {{ $item->id }} </td>
                                            <td>ِ {{ $item->title }} </td>
                                            <td> {{ $item->cost_price }} </td>
                                            <td> {{ $item->pivot->item_qty }} </td>
                                            <td> {{ $item->pivot->item_status ? "Ready to serve" :  "Not ready"}} </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td>No Items Found</td>
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
