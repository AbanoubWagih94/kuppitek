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
                        @if($user->role_id == 3) 
                        <a href="{{ route('staff.tables.create', $user->id) }}" class="btn btn-md round btn-outline-primary">Add Tables</a>
                        @elseif ($user->role_id == 2)
                        <a href="{{ route('staff.counter.create', $user->id) }}" class="btn btn-md round btn-outline-primary">Add Counter</a>
                        @endif
                        
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Country ID</th>
                                        <th>Phone Number</th>
                                        @if ($user->role_id == 3)
                                            <th>Tables Number</th>
                                        @endif
                                        <th>Member Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>ِ{{ $user->name }}</td>
                                        <td>ِ{{ $user->email }}</td>
                                        <td>{{ $user->userRole->title }}</td>   
                                        <td>ِ{{ $user->country_id }}</td>
                                        <td>ِ{{ $user->mobile_number }}</td>
                                        @if ($user->role_id == 3)
                                        <td>
                                            
                                            @forelse ($user->tables as $table)
                                                {{ $table->table_number}}
                                            @empty
                                                NO Tables
                                            @endforelse
                                            
                                        </td>
                                        @endif
                                        <td>ِ
                                            @if($user->image_path != "")
                                                <img src="{{ asset('assets/uploads/images/staff/'.$user->image_path) }}" width="200" height="200" class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('assets/images/profile_image.png')}}" width="200" height="200" class="img-thumbnail">
                                            @endif
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