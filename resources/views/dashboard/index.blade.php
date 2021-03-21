@extends('dashboard.layouts.app')
@section('dashboard.content')

    
                        <div class="">
                            <div class="">
                                <div class="btn-group">
                            <button class="btn1" title="Point Of Sale"><a href="#"><i class="fas fa-calculator fa-2x"></i></a><span>POS</span></button>
                            <button class="btn1" title="Counters"><a href="#"><i class="fas fa-cash-register fa-2x"></i></a><span>Counters</span></button>
                            <button class="btn1" title="Notifications"><a href="#"><i class="fas fa-bell fa-2x"></i></a><span>Notifications</span></button>
                            <button class="btn1" title="Analytics"><a href="#"><i class="fas fa-chart-bar fa-2x"></i></a><span>Analytics</span></button>
                            <button class="btn1" title="Orders"><a href="{{ route('orders.index') }}"><i class="fas fa-file-alt fa-2x"></i></a><span>Orders</span></button>
                        </div>
                            </div>
                            <div class="">
                                <div class="btn-group">
                                    <button class="btn2" title="Purchases"><a href="#"><i class="fas fa-shopping-basket fa-2x"></i></a><span>Purchases</span></button>
                                    <button class="btn2" title="Invoices"><a href="#"><i class="fas fa-file-invoice-dollar fa-2x"></i></a><span>Invoices</span></button>
                                    <button class="btn2" title="Reports"><a href="#"><i class="fas fa-file-invoice fa-2x"></i></a><span>Reports</span></button>
                                    <button class="btn2" title="Staff"><a href="{{ route('staff.index') }}"><i class="fas fa-id-card-alt fa-2x"></i></a><span>Staff</span></button>
                                    <button class="btn2" title="Customers"><a href="#"><i class="fas fa-users fa-2x"></i></a><span>Customers</span></button>
                                </div>
                            </div>
                            <div class="">
                                <div class="btn-group">
                                    <button class="btn3" title="Suppliers"><a href="#"><i class="fas fa-dolly fa-2x"></i></a><span>Suppliers</span></button>
                                    <button class="btn3" title="Branches"><a href="#"><i class="fas fa-store-alt fa-2x"></i></a><span>Branches</span></button>
                                    <button class="btn3" title="Products"><a href="#"><i class="fas fa-box-open fa-2x"></i></a><span>Products</span></button>
                                    <button class="btn3" title="Categories"><a href="{{ route('category.index') }}"><i class="fas fa-sitemap fa-2x"></i></a><span>Categories</span></button>
                                    <button class="btn3" title="Taxes"><a href="#"><i class="fas fa-percent fa-2x"></i></a><span>Taxes</span></button>
                                </div>
                            </div>
                            <div class="">
                                <div class="btn-group">
                                    <button class="btn4" title="Discounts"><a href="#"><i class="fas fa-tags fa-2x"></i></a><span>Discounts</span></button>
                                    <button class="btn4" title="Tables"><a href="{{ route('tables.index') }}"><i class="fas fa-microchip fa-2x"></i></a><span>Tables</span></button>
                                    <button class="btn4" title="Kitchen"><a href="{{ route('kitchen.index') }}"><i class="fas fa-utensils fa-2x"></i></a><span>Kitchen</span></button>
                                    <button class="btn4" title="Waiter"><a href="{{ route('waiter.index') }}"><i class="fas fa-user-tie fa-2x"></i></a><span>Waiter</span></button>
                                    <button class="btn4" title="Menu"><a href="{{ route('menuitem.index') }}"><i class="fas fa-clipboard-list fa-2x"></i></a><span>Menu</span></button>
                                </div>  
                            </div>
                        </div>
@endsection
