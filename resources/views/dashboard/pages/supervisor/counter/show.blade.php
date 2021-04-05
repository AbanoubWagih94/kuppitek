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
                            @if (!$counter->counter_status)
                                <a href="{{ route('counter.open.show', $counter->id) }}"
                                    class="btn btn-md round btn-outline-primary">Open Counter</a>
                            @else
                                <a href="{{ route('counter.open.close', $counter->id) }}"
                                    class="btn btn-md round btn-outline-primary">Close Counter</a>
                            @endif

                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                @include('dashboard.includes.errors')
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th>Counter Number</th>
                                            <th>Counter Status</th>
                                            @if ($counter->counter_status)
                                                <th>Start Money</th>
                                            @endif
                                            <th>Counter Users</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>ِ{{ $counter->counter_number }}</td>
                                            @if ($counter->counter_status)
                                                <td>
                                                    @foreach ($users as $user)
                                                        {{ $user->pivot->created_at > \Carbon\Carbon::today()->addHours(9) ? 'Opened by ' . $user->name : '' }}

                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($users as $user)
                                                        {{ $user->pivot->created_at > \Carbon\Carbon::today()->addHours(9) && $user->pivot->start_money != " " ? $user->pivot->start_money : '' }}

                                                    @endforeach
                                                </td>
                                                
                                            @else
                                                <td>
                                                    Closed
                                                </td>
                                            @endif
                                            <td>
                                                    <ul>
                                                        @forelse ( $users as $user)
                                                        @if ($user->role_id != 1)
                                                            <li>{{ $user->name }}</li>
                                                        @endif
                                                    
                                                @empty
                                                    No Users Found
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
