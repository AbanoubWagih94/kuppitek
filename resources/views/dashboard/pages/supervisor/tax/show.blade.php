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
                                        <th>Table Number</th>
                                        <th>Table Status</th>
                                        <th>Table  Waiters</th>
                                        <th>Generate QR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>ِ{{ $table->table_number }}</td>
                                        <td>ِ{{ $table->table_status ? "Busy" : "Not Busy"  }}</td>
                                        <td>
                                            @forelse ( $table->users as $user)
                                         <ul>
                                            <li>{{ $user->name }}</li>
                                         </ul>
                                    @empty
                                        No Waiters Found
                                    @endforelse    
                                        </td>   
                                        <td>
                                            <a class="btn btn-lg btn-outline-primary" href="{{ route('qrcode', $table->id) }}" target="_blank">Generate</a>
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