<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategories;
use App\Models\MenuItems;
use App\Models\Order;
use App\Models\OrderItems;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = MenuCategories::get();

        return view('menu',['categories'=>$categories]);
    }


    public function getitem(Request $request){
        // dd($request->all());


    //     <div class="col-md-4 col-sm-6">
    //     <div class="card border-0 mb-grid-gutter">
           
    //         <div class="card-body border mt-n1 py-4 text-center">
    //             <h2 class="h5 mb-1">Clothing</h2>
    //             <span class="d-block mb-3 font-size-xs text-muted">price  
    //                 <span class="font-weight-semibold">$49.99</span>
    //             </span>
    //             <a class="btn btn-pill btn-outline-primary btn-sm" href="shop-style1-ls.html">add to order</a>
    //         </div>
    //     </div>
    // </div>
    $html="";
        $MenuItems = MenuItems::where('category_id',$request->id)->get();
foreach($MenuItems as $item){
    $html .= <<<line
        <div class="col-md-4 col-sm-6">
        <div class="card border-0 mb-grid-gutter">
           
            <div class="card-body border mt-n1 py-4 text-center">
                <h2 class="h5 mb-1">$item[title]</h2>
                <span class="d-block mb-3 font-size-xs text-muted">price  
                    <span class="font-weight-semibold">$item[cost]</span>
                </span>
                <a class="btn btn-pill btn-outline-primary btn-sm" href="/addorder/$item[id]">add to order</a>
            </div>
        </div>
    </div>
    line;
}

         return response()->json($html);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function storeCart(Request $request,$id)
    {
        // $id2 = rand(1,1000);
        $MenuItems = MenuItems::findOrFail($id);
       $cart =  Cart::add($id, $MenuItems->title, 1,$MenuItems->cost);
        // dd(Cart::content());

        return back();
    }
    public function deleteItemCart(Request $request)
    {
        Cart::remove($request->id);
        return back();
    }
    public function clearCart()
    {
        Cart::destroy();
        return back();
    }

    public function order(){
        return view('addOrder');
    }

    public function saveOrder(Request $request){

        $name = $request->name;
        $phone = $request->phone;
        $order = Order::create([
            'user_id'=>1,
            'table_id'=>2,
            'total_cost'=>Cart::subtotal(),
            'order_status'=>1,
            ]);
            foreach(Cart::content() as $cart){
                OrderItems::create([
                    'item_id' => $cart->id, 
                    'order_id' => $order->id, 
                    
                    ]);

            }
        Cart::destroy();

        session()->flash('alert_message', ['message'=>" your order has been  recieved", 'icon'=>'success']);        

  return redirect('/order');
    //  dd($request->all());
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
