@extends('dashboard.layouts.app')

@section('dashboard.content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الطاولات</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('tables.create') }}"
                                class="btn btn-md round btn-outline-primary">Add Table</a>
                            
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                @include('dashboard.includes.errors')
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Table Number</th>
                                            <th>Table Status</th>
                                            <th>Table Waiters</th>
                                            <th>Control</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tables as $key => $table)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>ِ{{ $table ->table_number }}</td>
                                                <td>{{ $table->table_status ? "Busy" : "Empty" }}</td>
                                                <td>
                                                    @forelse($table->users as $user)
                                                        <h6>{{ $user->name }}</h6>
                                                    @empty
                                                        <h3>No Waiters selected </h3>
                                                    @endforelse
                                                </td>
                                                <td>
                                                    <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-sm round btn-outline-info">Edit</a>
                                                
                                                <form action="{{ route('tables.destroy', $table->id) }}" method="post" class="btn-group">
                                                       @csrf
                                                       @method('delete')
                                                        <button class="btn btn-sm round btn-outline-danger" onclick="return confirm('Do you want to remove this table?!')">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr >
                                                    <td class="text-center" colspan="5"><h1>No Tables</h1></td>
                                                </tr>
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
