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
                        <a href="{{ route('counter.create') }}" class="btn btn-md round btn-outline-primary">Add New Counter</a>           
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Counter Number</th>
                                        <th>Counter Status</th>
                                        <th>ِAction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($counters as $key => $counter)
                                    <tr>
                                        <td>{{ $counter->counter_number }}</td>
                                        <td>ِ{{ $counter->counter_number }}</td>
                                        <td>ِ{{ $counter->counter_status ? "opened" : "closed" }}</td>
                                        <td>
                                            <a href="{{ route('counter.show', $counter->id) }}" class="btn btn-sm round btn-warning"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('counter.edit', $counter->id) }}" class="btn btn-sm round btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('counter.destroy', $counter->id) }}" method="post">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-danger" onclick="return confirm('Do you want to remove this counter?!')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>    
                                    @empty
                                        <tr><td colspan="3">No Counters Found</td></tr>
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