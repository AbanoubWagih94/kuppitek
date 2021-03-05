@extends('admin.app')

@section('admin.content')
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
                        <a href="{{ url('/dashboard/staff/add') }}" class="btn btn-md round btn-outline-primary float-right">أضافة موظف</a>
                        <h4 class="card-title">طاقم العمل</h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @if(session('success'))
                                <div class="alert alert-success m-2">
                                    {{ session('success') }}
                                </div>
                            @elseif(session('error'))        
                            <div class="alert alert-danger m-2">
                                {{ session('error') }}
                            </div>
                            @endif
                            <table class="table table-de mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Edit</th>
                                        <th>Remove</th>
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
                                            <a href="{{ url('/dashboard/staff/edit', $user->id) }}" class="btn btn-sm round btn-outline-info">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/dashboard/staff/delete', $user->id) }}" class="btn btn-sm round btn-outline-danger">Remove</a>
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