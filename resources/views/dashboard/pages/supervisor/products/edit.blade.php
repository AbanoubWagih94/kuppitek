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
                        <div class="card-header mb-3">
                            <h4 class="card-title">ِEdit Product</h4>
                        </div>
                        <div class="card-content">
                            @include('dashboard.includes.errors')
                            <div class="container">
                                <form action="{{ Route('products.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="title">Product Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ $product->title }}" placeholder="Enter prodcut title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" name="category_id" id="category">
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $cat->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="sub_div">
                                        <label for="subcategory">Sub Category</label>
                                        <select class="form-control" name="sub_category_id" id="subcategory">
                                            <option value="0">Choose Product Sub Category</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cost_price">Cost Price</label>
                                        <input type="text" name="cost_price" id="cost_price" class="form-control"
                                            value="{{ $product->cost_price }}" placeholder="Enter product cost price"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="selling_price">Selling Price</label>
                                        <input type="text" name="selling_price" id="selling_price" class="form-control"
                                            value="{{ $product->selling_price }}"
                                            placeholder="Enter product selling price" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ingredients">Product Ingredients</label>
                                        <textarea type="textarea" name="ingredients" id="ingredients" class="form-control"
                                            rows="5"
                                            placeholder="Enter product ingredients">{{ $product->ingredients }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Product Image</label>
                                        <input type="file" class="form-control-file" name="image"
                                            value="{{ $product->image_path }}" id="image">
                                        <div class="mt-2">
                                            <img src="{{ $product->image_path != ' ' ? asset('assets/uploads/images/products/' . $product->image_path) : '' }}"
                                                id="img-preview" width="200px" />
                                        </div>
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
<script src="{{ url('assets/bootstrap/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#sub_div').hide()
        if (!$('category').val()) {
            subCategoryInput()
        }
        $('#category').on('change', e => {
            subCategoryInput()
        })
    })

    const subCategoryInput = () => {
        $.ajax({
            url: `/dashboard/products/create/${$('#category').val()}/sub`,
            success: data => {
                var product_id = {!! $product->sub_category_id == null ? 0 : $product->sub_category_id !!} ;
                if(data.subCategories.length < 1) {
                  $('#sub_div').hide()
                } else { 
                  $('#sub_div').show()
                  data.subCategories.forEach(sub =>
                    $('#subcategory').append(
                        `<option value="${sub.id}" ${product_id} == ${sub.id} ? 'selected' : '' >${sub.title}</option>`
                        )
                )
                }
            }
        })
    }

</script>
