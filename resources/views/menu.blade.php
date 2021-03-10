

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
        @include('admin.includes.header')
<style>


.header-top {
  height: 5rem;
  padding: 0.5rem;
  align-items: center;
}
.navbar-right {
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-items: center;
  height: 3rem;
}
.navbar-container ul {
  margin: 0;
  padding: 0;
}
.cart-icon img {
  font-size: 2rem;
  width: 100%;
}
.cart-icon {
  width: 2.5rem;
  position: relative;
  cursor: pointer;
}
</style>

<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">
            Your Order Cart
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-image">
            <thead>
              <tr>
                <th scope="col">item</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach(Cart::content()  as $cart)
              <tr>
               
                <td>{{$cart->name}}</td>
                <td>{{$cart->price}}</td>
                <td class="qty"><input type="text" class="form-control" id="input1" value="{{$cart->qty}}"></td>
                <td>
                  <a href="#" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table> 
          <div class="d-flex justify-content-end">
            <h5>Total: <span class="price text-success">{{ Cart::subtotal() }}</span></h5>
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a  href="{{url('/allorder')}}" class="btn btn-success">Order Now</a>
        </div>
      </div>
    </div>
  </div>

    <div id="app">
        
        @include('admin.includes.errors')

    <div class="container">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#cartModal">
            View Cart
          </button> 
   <div class="row">

  <div class="col-8">

       
        <!-- Categories grid-->
        <div class="row" id="data"> 
            <!-- Category-->
            {{-- <div id="msg"> --}}
<h4>  chose category  </h4>

            {{-- <div class="col-md-4 col-sm-6">
                <div class="card border-0 mb-grid-gutter">
                   
                    <div class="card-body border mt-n1 py-4 text-center">
                        <h2 class="h5 mb-1">Clothing</h2>
                        <span class="d-block mb-3 font-size-xs text-muted">price  
                            <span class="font-weight-semibold">$49.99</span>
                        </span>
                        <a class="btn btn-pill btn-outline-primary btn-sm" href="shop-style1-ls.html">add to order</a>
                    </div>
                </div>
            </div> --}}
        {{-- </div> --}}

            <!-- Category-->
    </div>

  </div>
  <div class="col-4">
    
                <div class="card">
                    <article class="filter-group">
                        <header class="card-header"> <a href="#" data-toggle="collapse" data-target="#collapse_aside1" data-abc="true" aria-expanded="false" class="collapsed"> <i class="icon-control fa fa-chevron-down"></i>
                                <h6 class="title">Categories </h6>
                            </a> </header>
                        {{-- <div class="filter-content collapse" id="collapse_aside1" style=""> --}}
                            <div class="card-body">
                                <ul class="list-menu">
                                    @foreach($categories as $cat)
                                    <li><a href="#" data-abc="true" onclick="getitems({{$cat->id}})">{{$cat->title}} </a></li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </article>
                
                </div>

  </div>


   </div>


</div>
</div>   
@include('admin.includes.footer') 

<script>


 function getitems($id){
console.log($id);

$.ajax({
               type:'get',
               url:'/getitem',
               data:{"id":$id},
               success:function(data) {
                   if(data){
                    $("#data").html(data);

                   } else{
                    $("#data").html("<h5> no items </h5");

                   }
               }
            });
    }
</script>


