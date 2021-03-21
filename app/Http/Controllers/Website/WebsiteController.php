<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MenuCategories;
use App\Models\MenuItems;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Table;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = MenuCategories::get();

        return view('website.index', ['categories' => $categories]);
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
        $name = $request->name;
        $phone = $request->phone;
        $table_number = 1;
        $table = Table::where('table_number', $table_number)->first();
        $customer = Customer::where('phone_number', $phone)->first();  
        $table->save();
        if (!$customer) {
            $customer = Customer::create([
                'name' => $name,
                'phone_number' => $phone,
            ]);
        }
        $order = Order::create([
            'customer_id' => $customer->id,
            'table_id' => $table->id,
            'total_cost' => Cart::subtotal(),
            'order_status' => 1,
        ]);

        foreach (Cart::content() as $cart) {
            OrderItems::create([
                'item_id' => $cart->id,
                'order_id' => $order->id,
                'item_qty' => $cart->qty
            ]);
        }
        Cart::destroy();

        session()->flash('alert_message', ['message' => " your order has been  recieved", 'icon' => 'success']);

        return redirect('/kuppitek');
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

    public function getItem(Request $request)
    {
        $html = "";
        $MenuItems = MenuItems::where('category_id', $request->id)->get();
        foreach ($MenuItems as $item) {
            $html .= <<<line
            <div class="col-lg-4" style='margin-bottom:5px'>
            <div class="box" data-aos="zoom-in" data-aos-delay="100">
            <h4>$item[title]</h4>
            <span><strong> Price:</strong> $item[cost]</span>
           
                <a    style=" cursor: pointer; :hover {background:white; cursor: pointer;}"  onclick="addTocart($item[id])">Add to Cart</a>
                </div>
                </div>
            line;
        }

        return response()->json($html);
    }


    public function storeItem(Request $request, $id)
    {
        $MenuItems = MenuItems::findOrFail($id);
        $cart =  Cart::add($id, $MenuItems->title, 1, $MenuItems->cost);


        $html_cart = '';
        $total = Cart::subtotal();
        foreach (Cart::content()  as $cart) {
            $html_cart .= <<<line
            <tr>
            <td>$cart->name</td>
            <td>$cart->price</td>
            <td class="qty">
            
            <div class="quantity buttons_added">
            <input type="button" value="-" class="minus"  onclick="minus($cart->id)" >
            <input type="number" step="1" min="1" max="" name="quantity" value="$cart->qty"  id="qty$cart->id" onchange="update_qty($cart->id)"  title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
            <input type="button" value="+" class="" onclick="add($cart->id)">
             </div>
            </td>
            <td>
              <a  class="btn btn-danger btn-sm"  onclick="deleteFromCart($cart->id)">
              <input type="hidden"  id="$cart->id" value="$cart->rowId">

                <i class="fa fa-times"> delete</i>
              </a>
            </td>
            </tr>
            
            line;
        }
        $tax = $total * 0.12;
        $service = $total * 0.14;
        $orderTotal = $total + $tax + $service;
        $subtota = <<<line2
        <div  style="display:inline-block">    
        <h5>Total: <span class=" text-success"> $total</span></h5> 
        <h5>Tax: <span class=" text-info">   $tax</span></h5> 
        <h5>Service: <span class=" text-info">   $service</span></h5> 
        <h4>Order Total: <span class=" text-primary">   $orderTotal</span></h4> 
        </div>
        line2;

        return response()->json(['html_cart' => $html_cart, 'sub' => $subtota]);
    }

    public function updateCart($id, $qty)
    {
        Cart::update($id, $qty);

        $total = Cart::subtotal();
        $tax = $total * 0.12;
        $service = $total * 0.14;
        $orderTotal = $total + $tax + $service;
        $subtota = <<<line2
        <div  style="display:inline-block">    
        <h5>Total: <span class=" text-success"> $total</span></h5> 
        <h5>Tax: <span class=" text-info">   $tax</span></h5> 
        <h5>Service: <span class=" text-info">   $service</span></h5> 
        <h4>Order Total: <span class=" text-primary">   $orderTotal</span></h4> 
        </div>
        line2;
        return response()->json(['sub' => $subtota]);
    }


    public function deleteItem($id)
    {

        // dd($id);
        //    $a= Cart::get($id);
        // dd($a);
        Cart::remove($id);

        $html_cart = '';
        $total = Cart::subtotal();
        foreach (Cart::content()  as $cart) {
            $html_cart .= <<<line
            <tr>
            <td>$cart->name</td>
            <td>$cart->price</td>
            <td class="qty">
            
            <div class="quantity buttons_added">
            <input type="button" value="-" class="minus"  onclick="minus($cart->id)" >
            <input type="number" step="1" min="1" max="" name="quantity" value="$cart->qty"  id="qty$cart->id" onchange="update_qty($cart->id)"  title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
            <input type="button" value="+" class="" onclick="add($cart->id)">
            </div>
            </td>
            <td>
              <a  class="btn btn-danger btn-sm"  onclick="deleteFromCart($cart->id)">
              <input type="hidden"  id="$cart->id" value="$cart->rowId">

                <i class="fa fa-times"> delete</i>
              </a>
            </td>
            </tr>
            
            line;
        }


        $tax = $total * 0.12;
        $service = $total * 0.14;
        $orderTotal = $total + $tax + $service;
        $subtota = <<<line2
        <div  style="display:inline-block">    
        <h5>Total: <span class=" text-success"> $total</span></h5> 
        <h5>Tax: <span class=" text-info">   $tax</span></h5> 
        <h5>Service: <span class=" text-info">   $service</span></h5> 
        <h4>Order Total: <span class=" text-primary">   $orderTotal</span></h4> 
        </div>
        line2;


        return response()->json(['html_cart' => $html_cart, 'sub' => $subtota]);
    }
}
