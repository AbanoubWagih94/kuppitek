

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
          
          <div class="d-flex justify-content-end">
            <h5>Total: <span class="price text-success">{{ Cart::total() }}</span></h5>
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Order Now</button>
        </div>
      </div>
    </div>
  </div>

    <div id="app">
        

    <div class="container">
        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#cartModal">
            View Cart
          </button>  --}}
   <div class="row">



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
  

   <form action="{{url('allorder')}}" method="POST">
    @csrf
     <div class="form-group">
   <h4 style="text-align: center" id="emailHelp" class="form-text text-muted">please complete your information to finish your order .</h4 style="text-align: center">

       <label for="exampleInputEmail1">your name</label>
       <input type="text" class="form-control" name="name" id="exampleInputEmail1"  placeholder="Enter your name">
     </div>
     <div class="form-group">
       <label for="exampleInputPassword1">phone</label>
       <input type="number" name="phone" class="form-control" id="" placeholder="phone">
     </div>
     
     <button type="submit" class="btn btn-primary">Order Now</button>
   </form>

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


