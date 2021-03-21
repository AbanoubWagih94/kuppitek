@extends('website.layouts.app')
@section('website-content')
    <main id="main">

        <!-- ======= Header ======= -->


        <section id="menu" class="menu section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Menu</h2>
                    <p>Categories</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">

                        <ul id="menu-flters">
                            @foreach ($categories as $cat)
                                <li data-filter="*" class="filter-active"><a
                                        onclick="getitems({{ $cat->id }})">{{ $cat->title }} </a></li>
                            @endforeach

                    </div>
                </div>

                <div class="row " style="height: !important" id="data" data-aos="fade-up" data-aos-delay="200">


                </div>

            </div>
        </section><!-- End Menu Section -->
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2> Menu</h2>
                    <p>Items</p>
                </div>

                <div class="row" id="data_html">



                </div>

            </div>
        </section>

        <section id="specials" class="specials">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>POS</h2>
                    <p> Your Order</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <table class="table " style="color: aliceblue; text-algin:center ">
                        <thead>
                            <tr>
                                <th scope="col">product</th>
                                <th scope="col">price</th>
                                <th scope="col">qty</th>
                                <th scope="col"> control</th>
                            </tr>
                        </thead>
                        <tbody id="carttable2">
                            @foreach (Cart::content() as $cart)
                                <tr>

                                    <td>{{ $cart->name }}</td>
                                    <td>{{ $cart->price }}</td>
                                    <td>

                                        <div class="quantity buttons_added">
                                            <input type="button" value="-" class="minus"
                                                onclick="minus({{ $cart->id }})">
                                            <input type="number" name="quantity" value="{{ $cart->qty }}"
                                                id="qty{{ $cart->id }}" onchange="update_qty({{ $cart->id }})"
                                                title="Qty" class="input-text qty text" min="1" max="">
                                            <input type="button" value="+" class="" onclick="add({{ $cart->id }})">
                                        </div>
                                    </td>

                                    <td>
                                        <a class="btn btn-danger" onclick="deleteFromCart({{ $cart->id }})">
                                            <input type="hidden" id="{{ $cart->id }}" value="{{ $cart->rowId }}">
                                            <i class="fa fa-times"> delete</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end" id="carttotal2">

                        @php
                            $total = Cart::subtotal();
                            
                            $tax = $total * 0.12;
                            $service = $total * 0.14;
                            $orderTotal = $total + $tax + $service;
                            
                        @endphp
                        <div style="display:inline-block">
                            <h5  id="total">Total: <span class="text-success">{{ $total }}</span></h5>
                            <h5>Tax: <span class=" text-info"> {{ $tax }}</span></h5>
                            <h5>Service: <span class=" text-info"> {{ $service }}</span></h5>
                            <h4>Order Total: <span class="text-primary"> {{ $orderTotal }}</span></h4>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        <!-- ======= Book A Table Section ======= -->
        <section id="book-a-table" class="book-a-table">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Reservation</h2>
                    <p>Book your Order</p>
                </div>

                <form action="{{ route('kuppitek.store') }}" method="post" data-aos="fade-up" data-aos-delay="100">
                    @csrf

                    <div class="form-row">
                        <div class="col-lg-4 col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name2" placeholder="Your Name" required>
                            <div class="validate"></div>
                        </div>

                        <div class="col-lg-4 col-md-6 form-group">
                            <input type="text" class="form-control" name="phone" id="phone1" placeholder="Your Phone" required>
                            <div class="validate"></div>
                        </div>
                    </div>
                    <button type="submit" id="order_button" disabled>Book Your Order</button>

                    <div class="text-center"></div>
                </form>

            </div>
        </section><!-- End Book A Table Section -->




    </main><!-- End #main -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#total").on("DOMSubtreeModified", "span", function() {
            alert("hi");
        });
    });

    function getitems(id) {
        $.ajax({
            type: 'GET',
            url: 'kuppitek/getitem' + '/' + id,
            success: function(data) {
                if (data) {
                    $("#data_html").html(data);

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
            url: 'kuppitek/addorder' + '/' + id,
            success: function(data) {
                if (data) {
                    // $("#carttable").html(data.html_cart);
                    $("#carttable2").html(data.html_cart);
                    // $("#carttotal").html(data.sub);
                    $("#carttotal2").html(data.sub);
                    updateOrderButton()
                } else {

                }
            }

        });
    }


    function deleteFromCart(id) {

        var row_id = document.getElementById(id).value;
        // var row_id = $("#"+id).val();

        $.ajax({
            type: 'GET',
            url: '/kuppitek/deleteitem' + '/' + row_id,
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


    function update_qty(id) {
        var row_id = document.getElementById(id).value;
        var qty = document.getElementById('qty' + id).value;

        $.ajax({
            type: 'GET',
            url: '/kuppitek/updatecart' + '/' + row_id + '/' + qty,
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
