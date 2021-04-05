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
                        <h3>Edit Supplier</h3>
                    </div>
                    <div class="card-content">
                        @include('dashboard.includes.errors')
                        <div class="container">
                            <form action="{{ Route('supplier.update', $supplier->id) }}" method="POST">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="form-group">
                                    <label for="supplierName">Supplier Name</label>
                                    <input type="text" name="name" id="supplierName" value="{{ $supplier->name }}" class="form-control"  placeholder="Enter supplier name">
                                  </div>
                                  <div class="form-group">
                                    <label for="phoneNumber">Supplier Phone Number</label>
                                    <input type="number" name="phone_number" id="phoneNumber" value="{{ $supplier->phone_number }}" class="form-control"  placeholder="Enter phone number">
                                  </div>
                                  <div class="form-group">
                                    <label for="address">Supplier Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="5">{{ $supplier->address }}</textarea>
                                  </div>
                                  <div class="form-group">
                                      <label for="payment_method">Payment Methods</label>
                                      <select class="form-control" name="payment_methods[]" id="payment_method" multiple="multiple">
                                        @foreach($payments as $payment)    
                                        <option value="{{ $payment->id }}" {{ in_array($payment->id, $payment_ids) == 1? 'selected' : ''}}>{{ $payment->title  }}</option>        
                                        @endforeach
                                      </select>
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