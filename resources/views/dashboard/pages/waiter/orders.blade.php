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
                        <div class="form-group">
                            <select class="form-control" name="product_id" id="sel_table">
                                <option>Choose Table</option>
                                @foreach ($tables as $key => $table)
                                    <option value="{{ $table->id }}"> 
                                        {{ $table->table_number }} 
                                    </option>
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            @include('dashboard.includes.errors')
                            <table class="table table-de mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Table Number</th>
                                        <th>Order Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                   
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
<script src="{{ url('assets/bootstrap/jquery-3.3.1.min.js') }}"></script>
<script type='text/javascript'>

    $(document).ready(function(){

      // Rable Change
      $('#sel_table').change(function(){

         // Table id
         var id = $(this).val();


         // AJAX request 
         $.ajax({
           url: 'orders/getorders/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){
         
             if(response.html != null){
                div = $("#table-body"); 
                div.html(response.html);
             }

             

           }
        });
      });

    });

    </script>