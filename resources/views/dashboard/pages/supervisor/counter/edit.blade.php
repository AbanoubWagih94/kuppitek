@extends('dashboard.layouts.app')

@section('dashboard.content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">
                    
                </h3>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-3">
                        <h3>Edit Counter</h3>
                    </div>
                    <div class="card-content">
                        @include('dashboard.includes.errors')
                        <div class="container">
                            <form action="{{ Route('counter.update', $counter->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="form-group">
                                    <label for="counterNumber">Counter Number</label>
                                    <input type="text" name="counter_number" value="{{ $counter->counter_number }}" id="counterNumber" class="form-control"  placeholder="Enter table number" disabled>
                                  </div>
                                <div class="form-group d-flex">
                                <button type="submit" class="btn btn-primary">Update</button>
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