@extends('admin.app')

@section('admin.content')
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
                        <h4 class="card-title">الطلبات</h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('admin.includes.errors')
                            @if(session('error'))        
                            <div class="alert alert-danger m-2">
                                {{ session('error') }}
                                {{ session()->forget('error') }}
                                </div>      
                            @endif
                            <table class="table table-de mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>اسم الطالب</th>
                                        <th>العنصر</th>
                                        <th>الكمية</th>
                                        <th>التكلفة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $key => $item)
                                    
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td> {{  $order->user->name }}</td>
                                        <td>ِ{{ $item->title }}</td>
                                        <td> {{ $item->pivot->item_qty  }} </td>
                                        <td>
                                            {{  $item->cost *$item->pivot->item_qty  }}
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