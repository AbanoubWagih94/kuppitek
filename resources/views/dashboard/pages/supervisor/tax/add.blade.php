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
                        <h3 class="card-title">Add New Tax</h3>
                    </div>
                    <div class="card-content">
                        @include('dashboard.includes.errors')
                        <div class="container">
                            <form action="{{ Route('tax.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                  <label for="tax_percentage">Tax Percentage</label>
                                  <input type="text" name="tax_percentage" id="tax_percentage" class="form-control"  placeholder="Enter tax percantage">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="tax_applied" id="tax_percentage" class="form-check-input">
                                    <label for="tax_applied">Apply Tax</label>
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