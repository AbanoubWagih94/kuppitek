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
                         @if($order->order_status == 1)
                         <a href="{{ route('waiter.add', $order->id) }}" class="btn btn-md round btn-outline-primary float-right">Add To Kitchen</a>
                         @elseif($order->order_status == 3)
                         <a href="{{ route('waiter.toTable', $order->id) }}" class="btn btn-md round btn-outline-primary float-right">Serve Order To Table</a>
                         @endif
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Customer Name</th>
                                        <th>Item</th>
                                        <th>Quentity</th>
                                        <th>Cost</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $key => $item)
                                    
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td> {{  $order->customer->name }}</td>
                                        <td>ِ{{ $item->title }}</td>
                                        <td> {{ $item->pivot->item_qty  }} </td>
                                        <td>
                                            {{  $item->cost *$item->pivot->item_qty  }}
                                        </td>
                                        <td>
                                            <form action="{{ route('waiter.remove.item', $order->id) }}" method="post" class="btn-group">
                                                @csrf
                                                @method('delete')
                                                 <button class="btn btn-sm round btn-outline-danger" onclick="return confirm('Do you want to remove this item?!')">Remove</button>
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