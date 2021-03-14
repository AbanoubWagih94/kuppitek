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
                                        <th>Customer Name</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Cost</th>
                                        <th>finish</th>
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
                                            <a href="{{  route('kitchen.finish', $order->id) }}" class="btn btn-sm round btn-outline-danger" onclick="return confirm('Does this order finsih?')">Finsih</a>
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