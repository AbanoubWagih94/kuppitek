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
                                        <th>رقم الطاولة</th>
                                        <th>حالة الطلب</th>
                                        <th>تفاصيل الطلب</th>
                                        <th>الغاء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $key => $order)
                                    
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>ِ{{ $order->table_id }}</td>
                                        @if( $order->order_status == 1)
                                            <td>لم يخدم حتى الان</td>
                                        @elseif($order->order_status == 2)
                                        <td>الطلب فى المطبخ الان</td>    
                                        @elseif($order->order_status == 3)
                                        <td>تم تجهيز الطلب</td>    
                                        @elseif($order->order_status == 4)
                                        <td>الطلب الان على الطاولة</td>    
                                        @endif
                                        <td>
                                            <a href="{{ url('/waiter_orders/show', $order->id) }}" class="btn btn-sm round btn-outline-info">تفاصيل الطلب</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/waiter_orders/delete', $order->id) }}" class="btn btn-sm round btn-outline-danger" onclick="return confirm('هل انت متاكد من حذف هذا العنصر')">Remove</a>
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