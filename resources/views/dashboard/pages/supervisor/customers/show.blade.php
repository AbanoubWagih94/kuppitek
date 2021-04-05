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
                                            <th>Customer Name</th>
                                            <th>Customer Phone Number</th>
                                            <th>Total Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>ِ{{ $customer->name }}</td>
                                            <td>ِ{{ $customer->phone_number }}</td>
                                            <td>
                                                {{ $customer->total_paid }}
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
