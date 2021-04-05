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
                        <div class="card-header mb-2">
                            <h4 class="card-title">Add New Product</h4>
                        </div>
                        <div class="card-content">
                            @include('dashboard.includes.errors')

                            <div class="container">
                                <form action="{{ Route('products.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="title">Product Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Enter prodcut title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" id="category" name="category_id">
                                          <option>Choose Product Category</option>  
                                          @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="sub_div">
                                        <label for="subcategory">Sub Category</label>
                                        <select class="form-control" name="sub_category_id" id="subcategory">
                                            <option>Choose Product Sub Category</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="cost_price">Cost Price</label>
                                        <input type="text" name="cost_price" id="cost_price" class="form-control"
                                            placeholder="Enter product cost price" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="selling_price">Selling Price</label>
                                        <input type="text" name="selling_price" id="selling_price" class="form-control"
                                            placeholder="Enter product selling price" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ingredients">Product Ingredients</label>
                                        <textarea type="textarea" name="ingredients" id="ingredients" class="form-control"
                                            rows="5" placeholder="Enter product ingredients"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Product Image</label>
                                        <input type="file" class="form-control-file" name="image" id="image">
                                        <div class="mt-2">
                                            <img src=" " id="img-preview" width="200px" />
                                        </div>
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
<script src="{{ url('assets/bootstrap/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function() {
      $('#sub_div').hide()
        $('#category').on('change', e => {
            $.ajax({
                url: `/dashboard/products/create/${$('#category').val()}/sub`,
                success: data => {
                  $('#sub_div').show()
                    data.subCategories.forEach(sub =>
                        $('#subcategory').append(
                            
                            `<option value="${sub.id}">${sub.title}</option>`)
                    )
                }
            })
        })
    })

</script>
