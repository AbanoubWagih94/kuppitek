<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\MenuCategories;
use App\Models\MenuItems;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Table;
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

        return view('menu', ['categories' => $categories]);
    }


    public function getitem(Request $request)
    {
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
        $html = "";
        $MenuItems = MenuItems::where('category_id', $request->id)->get();
        foreach ($MenuItems as $item) {
            $html .= <<<line
        <div class="col-md-4 col-sm-6 mt-2">
        <div class="card border-0 mb-grid-gutter">
           
            <div class="card-body border mt-n1 py-4 text-center">
                <h2 class="h5 mb-1" style="color:black;">$item[title]</h2>
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

    public function storeCart(Request $request, $id)
    {
        // $id2 = rand(1,1000);
        $MenuItems = MenuItems::findOrFail($id);

        $cart = Cart::add($id, $MenuItems->title, 1, $MenuItems->cost,);

        session()->put('alert_message', ['message' => "تم أضافة العنصر ", 'icon' => 'success']);
        return redirect()->back();
    }
    public function deleteItemCart($id)
    {
        Cart::remove($id);
        session()->put('alert_message', ['message' => "تم حذف العنصر ", 'icon' => 'success']);
        return redirect()->back();
    }
    public function clearCart()
    {
        Cart::destroy();
        return back();
    }

    public function order()
    {
        return view('addOrder');
    }

    public function saveOrder(Request $request, $table_number)
    {

        $name = $request->name;
        $phone = $request->phone;
        $table_number = $table_number;
        $table = Table::where('table_number', $table_number)->first();
        $customer = Customer::where('phone_number', $phone)->first();
        $table->table_status = 1;
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
                'item_qty'=> $cart->qty
            ]);
        }
        Cart::destroy();

        session()->flash('alert_message', ['message' => " your order has been  recieved", 'icon' => 'success']);

        return redirect('/landpage');
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

    public function landpage(){
        $categories = MenuCategories::get();
        return view('landpage',['categories'=>$categories]);
    }
}
