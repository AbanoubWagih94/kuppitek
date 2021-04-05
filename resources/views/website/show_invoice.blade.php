@extends('website.layouts.app')
@section('website-content')
    <main id="main">

        <!-- ======= Header ======= -->
        <div class="title">
            <img src="{{ asset('assets/images/Kuppitek-Logo-xsmall-TR.png') }}" />
        </div>

        <div class="ads text-center">ADS</div>

        <div class="mb-3">
            <div class="container-fluid invoice">
                <div class="row" id="items_html">
                    <div class="invoice-section">
                            <h5  >Order Number: {{ $order->id }}#</h5>
                            <h5>Order Status: 
                                @switch($order->order_status)
                                    @case(1)
                                        Order not served
                                        @break
                                    @case(2)
                                        Order in kitchen
                                        @break
                                    
                                    @case(3)
                                        Order is ready
                                        @break
                                    
                                    @case(4)
                                        Order is served
                                        @break
                                    
                                    @default
                                        
                                @endswitch
                            </h5>
                            <h5>Date: {{ Carbon\Carbon::now()->toDateTimeLocalString() }}</h5>
                            <h5>Waiter Name: {{ $waiter->name }}</h5>    
                            <h5>Items Price: <span class=" text-success">{{ Cart::subtotal() }}</span> EGP</h5> 
                            <h5>Vat: <span class=" text-info"></span> {{ $tax}}%</h5> 
                            <h4>Order Price: <span class=" text-primary"> </span> {{ $order->total_cost }} EGP</h4> 
                            </div>
                </div>
            </div>
        </div>
            <div class="contacts mb-3">  
                <div class="container-fluid invoice">
                    
                        <a href="{{ route('digital.menu', $order->table->table_number) }}" class="btn btn-primary"> Update Your Order</a>
                               </div>
            </div>
       

    </main><!-- End #main -->
@endsection
