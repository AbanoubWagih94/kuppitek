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
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                @include('dashboard.includes.errors')
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Supplier Phone Number</th>
                                            <th>Supplier Address</th>
                                            <th>Payment Methods</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>ِ{{ $supplier->name }}</td>
                                            <td>ِ{{ $supplier->phone_number }}</td>
                                            <td>ِ{{ $supplier->address }}</td>
                                            <td>
                                                <ul>
                                                    @forelse ( $supplier->payments as $payment)
                                                        
                                                        <li>{{ $payment->title }}</li>

                                                    @empty
                                                        No Payments Found
                                                    @endforelse
                                                </ul>
                                            </td>
                                        </tr>

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
