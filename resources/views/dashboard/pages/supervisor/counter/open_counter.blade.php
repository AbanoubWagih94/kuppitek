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
                        <h3 class="card-title">Open Counter Number {{ $counter->counter_number }}</h3>
                    </div>
                    <div class="card-content">
                        @include('dashboard.includes.errors')
                        <div class="container">
                            <form action="{{ Route('counter.open.store', $counter->id) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                  <label for="start_money">Start Cash</label>
                                  <input type="number" name="start_money" id="start_money" class="form-control"  placeholder="Enter counter start cash">
                                </div>
                                <div class="form-group d-flex">
                                <button type="submit" class="btn btn-primary">Open</button>
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