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
                                            <th>Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($order->items as $item)
                                        @if (!$item->pivot->item_status)
                                        <tr>
                                            <td>ِ {{ $item->id }} </td>
                                            <td>ِ {{ $item->title }} </td>
                                            <td> {{ $item->pivot->item_qty }} </td>
                                            <td> <a class='btn btn-sm round btn-success'
                                                href="{{ route('kitchen.finish', ['order_id' => $order->id, 'product_id' => $item->id]) }}"
                                                onclick="return confirm('This Item finished?!')"><i class="fas fa-check-square"></i></a>  </td>
                                        </tr>
                                        @endif
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
