@extends('dashboard.layouts.app')
@section('dashboard.content')    
                        <div class="">
                            <div class="">
                                <div class="btn-group">
                            <button class="btn1" title="Point Of Sale"><a href="#"><i class="fas fa-calculator fa-2x"></i></a><span>POS</span></button>
                            <button class="btn1" title="Counters"><a href="{{ route('cashier.counter') }}"><i class="fas fa-cash-register fa-2x"></i></a><span>Counters</span></button>
                            <button class="btn1" title="Orders"><a href="{{ route('cashier.orders') }}"><i class="fas fa-file-alt fa-2x"></i></a><span>Orders</span></button>
                        </div>
                            </div>
                            <div class="">
                                <div class="btn-group">
                                    <button class="btn4" title="Notifications"><a href="#"><i class="fas fa-bell fa-2x"></i></a><span>Notifications</span></button>
                                    <button class="btn4" title="Products"><a href="{{  route('products.index') }}"><i class="fas fa-box-open fa-2x"></i></a><span>Products</span></button>
                                </div>  
                            </div>
                        </div>
@endsection
