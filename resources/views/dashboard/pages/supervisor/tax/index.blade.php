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
                        @if($taxes->count() <1)
                        <a href="{{ route('tax.create') }}" class="btn btn-md round btn-outline-primary">Add New Tax</a>
                        @endif
                        
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tax Percentage</th>
                                        <th>Tax Applied</th>
                                        <th>ِAction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($taxes as $key => $tax)
                                    <tr>
                                        <td>{{ $tax->id }}</td>
                                        <td>ِ{{ $tax->tax_percentage }}</td>
                                        <td>
                                            @if($tax->tax_applied)
                                            <span class="text-success"><i class="fas fa-check-square"></i></span>
                                            @else
                                            <span class="text-danger"><i class="fas fa-window-close"></i></span>    
                                            @endif
                                        </td>
                                        <td>
                                            
                                            <a href="{{ route('tax.edit', $tax->id) }}" class="btn btn-sm round btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('tax.destroy', $tax->id) }}" method="post">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-danger" onclick="return confirm('Do you want to remove this tax?!')"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>    
                                    @empty
                                        <tr><td colspan="3">No Tax Found</td></tr>
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