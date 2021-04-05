@extends('dashboard.layouts.app')
@section('dashboard.content')    
                    <div class="">
                        <div class="btn-group">
                            <button class="btn1" title="Notifications"><a href="#"><i class="fas fa-bell fa-2x"></i></a><span>Notifications</span></button>
                            <button class="btn1" title="Orders"><a href="{{ route('kitchen.orders') }}"><i class="fas fa-file-alt fa-2x"></i></a><span>Orders</span></button>
                        </div>
                    </div>
@endsection
