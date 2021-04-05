@extends('website.layouts.app')
@section('website-content')
    <main id="main">

        <!-- ======= Header ======= -->
        <div class="title">
            <img src="{{ asset('assets/images/Kuppitek-Logo-xsmall-TR.png') }}" />
        </div>

        <div class="ads text-center">ADS</div>


        <ul class="navbar text-center">
            <div class="container">
                <div class="row">
                    @forelse ($categories as $category)
                        <li><a href="#"
                                onclick="getitems({{ $category->id }}, {{ $category->subCategories }}, 'category')" >{{ $category->title }}
                            </a>
                        </li>

                    @empty
                        No Categories Found
                    @endforelse
                </div>
            </div>
        </ul>

        <div class="mt-3" id="subCategories_html">
        </div>

        <div class="products mb-3">
            <div class="container-fluid">
                <div class="row" id="items_html">
                </div>
            </div>
        </div>

        @if ($table != null)
            <div class="orders">
                <h3 class="">
                    <div class="container-fluid">Table Number: {{ $table->table_number }}</div>
                </h3>
                <div class="container-fluid">
                    <div class="row">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">products</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="carttable2" class="text-center">

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    
                    <div class="total" id="carttotal2">
                    </div>
                </div>
            </div>

            <div class="contacts">
                <h3>
                    <div class="container-fluid">Book Your Order</div>
                </h3>
                @if(session()->has('customer') && session()->has(session('customer')->phone_number))
                <div class="container-fluid">
                    <form action="{{ route('kuppitek.update', session(session('customer')->phone_number)->id) }}" method="post" class="form text-center">
                        @csrf
                        @method('PUT')
                        <input type="submit" id="order_button" class="btn" value="Update Your Order" disabled />
                    </form>
                </div>
                @else
                {{ Cart::destroy() }}
                <div class="container-fluid">
                    <form action="{{ route('kuppitek.store') }}" method="post" class="form text-center">
                        @include('dashboard.includes.errors')
                        @csrf
                        <input type="text" name="name" class="form-control" id="name2" placeholder="Your Name" required>
                        <div class="validate"></div>

                        <input type="number" class="form-control" name="phone" id="phone1" placeholder="Your Phone Number"
                            required>
                        <div class="validate"></div>

                        <input type="submit" id="order_button" class="btn" value="Book Your Order" disabled />
                    </form>
                </div>
                @endif
            </div>
        @endif

    </main><!-- End #main -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function getitems(id, subCategories, type) {
        var url;
        var div;
        if (subCategories.length > 0) {
            url = '/kuppitek/menu/getSubCategories' + '/' + id   
        } 
        else  {
          if( type != "sub_category") {
            $("#subCategories_html").html("");
          }
            url = '/kuppitek/menu/getitem' + '/' + id + '/' + type
        }
        $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
                if (data) {
                    div = subCategories.length > 0 ? $("#subCategories_html") : $("#items_html"); 
                    div.html(data);
                } else {
                    console.log(data);
                    $("#data").html("<h5> no items </h5");

                }
            }
        });
    }


    function addTocart(id) {
        $.ajax({
            type: 'GET',
            url: '/kuppitek/menu/addorder' + '/' + id,
            success: function(data) {
                if (data) {
                    $("#carttable2").html(data.html_cart);
                    $("#carttotal2").html(data.sub);
                    updateOrderButton()
                } else {

                }
            }

        });
    }


    function deleteFromCart(id) {
        var checkRemove = confirm('Do you want to remove this item?!');
        if (checkRemove) {
            var row_id = document.getElementById(id).value;
            $.ajax({
                type: 'GET',
                url: '/kuppitek/menu/deleteitem' + '/' + row_id,
                success: function(data) {
                    if (data) {
                        $("#carttable2").html(data.html_cart);
                        $("#carttotal2").html(data.sub);
                        updateOrderButton()
                    } else {

                    }
                }

            });
        }
    }


    function update_qty(id) {
        var row_id = document.getElementById(id).value;
        var qty = document.getElementById('qty' + id).value;

        $.ajax({
            type: 'GET',
            url: '/kuppitek/menu/updatecart' + '/' + row_id + '/' + qty,
            success: function(data) {
                if (data) {
                    $("#carttotal2").html(data.sub);

                } else {

                }
                updateOrderButton()
            }

        });


    }

    function add(id) {
        var qty = document.getElementById('qty' + id).value;
        qty++;
        var qty2 = document.getElementById('qty' + id).value = qty;
        update_qty(id);

    }

    function minus(id) {
        var qty = document.getElementById('qty' + id).value;
        if (qty > 1) {
            qty--;
        }
        var qty2 = document.getElementById('qty' + id).value = qty;

        update_qty(id);

    }

    function updateOrderButton() {
        var order_button = document.getElementById('order_button');
        var tableRows = document.getElementById('carttable2').rows.length;
        if (tableRows > 0) {
            order_button.disabled = false;
        } else {
            order_button.disabled = true;
        }
    }

</script>
