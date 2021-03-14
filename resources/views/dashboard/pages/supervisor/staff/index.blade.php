@extends('dashboard.layouts.app')
@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">طاقم عمل kuppitek</h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('staff.create') }}" class="btn btn-md round btn-outline-primary">Add New Member</a>
                        
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Member Information</th>
                                        <th>Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key => $user)
                                    @if($user->role_id)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>ِ{{ $user->name }}</td>
                                        <td>{{ $user->userRole->title }}</td>
                                        <td>
                                            <a href="{{ route('staff.show', $user->id) }}" class="btn btn-sm round btn-outline-info">Member</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('staff.edit', $user->id) }}" class="btn btn-sm round btn-outline-info">Edit</a>
                                        
                                        <form action="{{ route('staff.destroy', $user->id) }}" method="post" class="btn-group">
                                               @csrf
                                               @method('delete')
                                                <button class="btn btn-sm round btn-outline-danger" onclick="return confirm('Do you want to remove this category?!')">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    
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