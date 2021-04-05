@extends('dashboard.layouts.app')
@section('dashboard.content')    
                        <div class="">
                            <div class="">
                                <div class="btn-group">
                            <button class="btn1" title="Notifications"><a href="#"><i class="fas fa-bell fa-2x"></i></a><span>Notifications</span></button>
                            <button class="btn1" title="Orders"><a href="{{ route('waiter.orders.index') }}"><i class="fas fa-file-alt fa-2x"></i></a><span>Orders</span></button>
                        </div>
                            </div>
                            <div class="">
                                <div class="btn-group">
                                    <button class="btn4" title="Menu"><a href="{{ route('kuppitek.index') }}"><i class="fas fa-clipboard-list fa-2x"></i></a><span>Menu</span></button>
                                </div>  
                            </div>
                        </div>
@endsection
