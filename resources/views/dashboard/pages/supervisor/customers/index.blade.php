@extends('dashboard.layouts.app')
@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">    
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>ِAction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($customers as $key => $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>ِ{{ $customer->name }}</td>
                                        <td>
                                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm round btn-warning"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm round btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-danger" onclick="return confirm('Do you want to remove this customer?!')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>    
                                    @empty
                                        <tr><td colspan="3">No Customers Found</td></tr>
                                    @endforelse
                                    
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