@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"></h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <h4 class="card-title">Add Counter To <b>{{ $user->name }}</b></h4>
                    </div>
                    <div class="card-content">
                        @include('dashboard.includes.errors')
                       
                        <div class="container">
                            <form action="{{ Route('staff.counter.store', $user->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="counter_id">Choose Counter</label>
                                    <select class="form-control" name="counter_id" id="counter_id" >
                                      @forelse($counters as $counter)
                                      <option value="{{ $counter->id }}">{{ $counter->counter_number }}</option>
                                      @empty
                                          <option>No Counters Found</option>
                                      @endforelse
                                    </select>
                                  </div>
                                
                                <div class="form-group d-flex">
                                <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection