<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MenuCategories;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tax;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
  protected $tax;

  public function __construct()
  {
    $this->tax = Tax::all();
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $table = null;
    $categories = MenuCategories::get(); 
    return view('website.index', ['categories' => $categories, 'table' => $table,]);
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
    $request->validate([
      'name'=> 'required|alpha',
      'phone'=> 'required|numeric'
    ]);
    $name = $request->name;
    $phone = $request->phone;
    $table_number = session('table_number');
    $table = Table::where('table_number', $table_number)->first();
    $customer = Customer::where('phone_number', $phone)->first();
    $waiter = session('table_waiter');
    $subTotal = Cart::subtotal();
    $total = (($subTotal * $this->tax[0]->tax_percentage) / 100) + $subTotal;
    if (!$customer) {
      $customer = Customer::create([
        'name' => $name,
        'phone_number' => $phone,
      ]);
    }
    $order = Order::create([
      'customer_id' => $customer->id,
      'table_id' => $table->id,
      'user_id' => $waiter->id,
      'counter_id' => NULL,
      'total_cost' => $total,
      'order_status' => 1,
    ]);

    foreach (Cart::content() as $cart) {
      OrderItems::create([
        'product_id' => $cart->id,
        'order_id' => $order->id,
        'item_qty' => $cart->qty
      ]);
      Cart::instance($customer->phone_number)->add($cart->id, $cart->name, 1, $cart->price);
    }

    session()->put($customer->phone_number, $order);
    session()->put('customer', $customer);

    session()->flash('alert_message', ['message' => "Your order has been recieved your order number is ".$order->id."#", 'icon' => 'success']);
    return redirect('/kuppitek/menu/show/invoice/'.$order->id);
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
    $item_exist = false;
    $order = Order::find($id); 
    $table_number = session('table_number');
    $subTotal = Cart::subtotal();
    $total = (($subTotal * $this->tax[0]->tax_percentage) / 100) + $subTotal;
    $order->total_cost = $total ;
    $order->save();
    $orderItems = OrderItems::where('order_id', $order->id)->get(); 
    foreach($orderItems as $item) {
      foreach (Cart::content() as $cart) {
        if($item->product_id == $cart->id) {
          $item->item_qty = $cart->qty; 
          $item->save();
          $item_exist = true;
        } 
      }
      if(!$item_exist) {
        $item->delete();
      } 
      $item_exist = false;
    }
    foreach(Cart::content() as $cart) {
      $orderItem = OrderItems::where('order_id', $order->id)->where('product_id', $cart->id)->first();
          if(!$orderItem) {
            OrderItems::create([
              'product_id' => $cart->id,
              'order_id' => $order->id,
              'item_qty' => $cart->qty
            ]);
          }
    } 
    $customer = session('customer'); 
    session()->put($customer->phone_number, $order);
    session()->flash('alert_message', ['message' => "Your order has been updated your order number is ".$order->id."#", 'icon' => 'success']);
    return redirect('/kuppitek/menu/show/invoice/'.$order->id);
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
  public function getMenu($table_number)
  {
    $order = session()->has('customer') ? session(session('customer')->phone_number) : null ;
    $order = $order ? Order::find($order->id): null;
    if($order && $order->order_status == 5) {
      $customer = session('customer');
      session()->forget($customer->phone_number);
      session()->forget('customer');
    }
    session()->put('table_number', $table_number);
    $table = Table::where('table_number', $table_number)->first();
    $tableUsers = $table->users;
    foreach ($tableUsers as $user) {
      if ($user->update_at > Carbon::today()->addHours(9)) {
        $waiter = $user;
        session()->put('table_waiter', $waiter);
      } else {
        $waiter = $user;
        session()->put('table_waiter', $waiter);
      }
    }
    $categories = MenuCategories::get();
    return view('website.index', ['categories' => $categories, 'table' => $table, ]);
  }
  public function getSubCategories(Request $request)
  {
    $category = MenuCategories::find($request->id);
    $html = "";
    if ($category->subCategories->count() > 0) {
      foreach ($category->subCategories as $subCategory) {
        $html .= <<<line
                    <ul class="navbar text-center">
                    <div class="container">
                    <div class="row">
                    <li ><a href="#" onclick="getitems( $subCategory->id, [], 'sub_category')"> $subCategory->title </a>
                    </li>                
                    </div>
                  </div>
                  </ul>
              line;
      }
    }
    return response()->json($html);
  }

  public function getItem($id, $type)
  {
    $html = "";
    $products = $type == 'category' ?  Product::where('category_id', $id)->get() : Product::where('sub_category_id', $id)->get();
    if ($products->count() > 0) {
      foreach ($products as $product) {
        $image_path = $product->image_path != "" ? asset('assets/uploads/images/products/' . $product->image_path) : asset('assets/images/product.png');
        $plus_icon = asset('assets/images/plus.png');
        $html .= <<<line
              <div class="item col-md-6 col-sm-12 col-xs-12">
                <div class="row">
                  <div class="left">
                    <div class="head row">
                    <a  class="btn btn-md ml-2" onclick="addTocart($product[id])">
                    <img
                    src="$plus_icon"
                  />
                    </a>
                    <h3>$product[title]</h3>
                    </div>
                    <span class="price"> $product[selling_price] Egp </span> 
                    </div>
                    <div class="right">
                      <img src="$image_path" width="60%" height="150">
                    </div>
                  </div>
                </div>
              line;
      }
    } else {
      $html = "<div class='text-center'>No Products Found</div>";
    }

    return response()->json($html);
  }


  public function storeItem($id)
  {
    $product = Product::findOrFail($id);
    $cart =  Cart::add($id, $product->title, 1, $product->selling_price);
    $html_cart = '';
    $total = Cart::subtotal();
    foreach (Cart::content()  as $cart) {
      $html_cart .= <<<line
            <tr>
                            <td>$cart->name</td>
                            <td>$cart->price</td>
                            <td>
                  
                              <div class="quantity buttons_added">
                                <input type="button" value="-" class="minus"  onclick="minus($cart->id)" >
                                <input type="number" class="w-25" step="1" min="1" max="" name="quantity" value="$cart->qty"  id="qty$cart->id" onchange="update_qty($cart->id)"  title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                <input type="button" value="+" class="" onclick="add($cart->id)">
                              </div>
                            </td>
                            
                            <td>
                              <a  class="btn btn-danger"  onclick="deleteFromCart($cart->id)">
                                <input type="hidden"  id="$cart->id" value="$cart->rowId">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                              
                            </td>
                          </tr>
            
            line;
    }
    $waiter = session('table_waiter');
    $order = session()->has('customer') ? session(session('customer')->phone_number) : null ;
    
    $total = Cart::subtotal();
    $tax = $this->tax[0]->tax_percentage;
    $orderTotal = $total + (($total * $tax) / 100);
    $date = Carbon::now()->toDateTimeLocalString();
    
    $subtotal = '<div style="display:inline-block">';
    $subtotal .=    $order ? '<h5 class ="text-center" >Order Number: '  . $order->id . '#</h5>' : '<span></span>';
    $subtotal .=    '<h5>Date: '. $date . '</h5>
        <h5> Waiter Name: ' .$waiter->name. '</h5>    
        <h5>Items Price: <span class=" text-success">' .$total. '</span> EGP</h5> 
        <h5>Vat: <span class=" text-info">'   .$tax. '</span> %</h5> 
        <h4>Order Price: <span class=" text-primary">'   .$orderTotal. '</span> EGP</h4> 
        </div>';


    return response()->json(['html_cart' => $html_cart, 'sub' => $subtotal]);
  }

  public function updateCart($id, $qty)
  {
    Cart::update($id, $qty);
    $waiter = session('table_waiter');
    $order = session()->has('customer') ? session(session('customer')->phone_number) : null ;
    $total = Cart::subtotal();
    $tax = $this->tax[0]->tax_percentage;
    $orderTotal = $total + (($total * $tax) / 100);
    $date = Carbon::now()->toDateTimeLocalString();
    $subtotal = '<div style="display:inline-block">';
    $subtotal .=    $order ? '<h5 class ="text-center" >Order Number: '  . $order->id . '#</h5>' : '<span></span>';
    $subtotal .=    '<h5>Date: '. $date . '</h5>
        <h5> Waiter Name: ' .$waiter->name. '</h5>    
        <h5>Items Price: <span class=" text-success">' .$total. '</span> EGP</h5> 
        <h5>Vat: <span class=" text-info">'   .$tax. '</span> %</h5> 
        <h4>Order Price: <span class=" text-primary">'   .$orderTotal. '</span> EGP</h4> 
        </div>';
    return response()->json(['sub' => $subtotal]);
  }


  public function deleteItem($id)
  {
    Cart::remove($id);
    $waiter = session('table_waiter');
    $html_cart = '';
    $total = Cart::subtotal();
    foreach (Cart::content()  as $cart) {
      $html_cart .= <<<line
            <tr>
                            <td>$cart->name</td>
                            <td>$cart->price</td>
                            <td>
                  
                              <div class="quantity buttons_added">
                                <input type="button" value="-" class="minus"  onclick="minus($cart->id)" >
                                <input type="number" class="w-25" step="1" min="1" max="" name="quantity" value="$cart->qty"  id="qty$cart->id" onchange="update_qty($cart->id)"  title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                <input type="button" value="+" class="" onclick="add($cart->id)">
                              </div>
                            </td>
                            
                            <td>
                              <a  class="btn btn-danger"  onclick="deleteFromCart($cart->id)">
                                <input type="hidden"  id="$cart->id" value="$cart->rowId">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                              
                            </td>
                          </tr>
            
            line;
    }


    $total = Cart::subtotal();
    $order = session()->has('customer') ? session(session('customer')->phone_number) : null ;
    $tax = $this->tax[0]->tax_percentage;
    $orderTotal = $total + (($total * $tax) / 100);
    $date = Carbon::now()->toDateTimeLocalString();
    $subtotal = '<div style="display:inline-block">';
    $subtotal .=    $order ? '<h5 class ="text-center" >Order Number: '  . $order->id . '#</h5>' : '<span></span>';
    $subtotal .=    '<h5>Date: '. $date . '</h5>
        <h5> Waiter Name: ' .$waiter->name. '</h5>    
        <h5>Items Price: <span class=" text-success">' .$total. '</span> EGP</h5> 
        <h5>Vat: <span class=" text-info">'   .$tax. '</span> %</h5> 
        <h4>Order Price: <span class=" text-primary">'   .$orderTotal. '</span> EGP</h4> 
        </div>';
    return response()->json(['html_cart' => $html_cart, 'sub' => $subtotal]);
  }

  public function showInvoice($order_id) {
    $order = Order::find($order_id);
    $tax = $this->tax[0]->tax_percentage;
    $waiter = User::find($order->user_id);
    if($order) {
      return view('website.show_invoice', ['order'=> $order, 'tax'=> $tax, 'waiter'=> $waiter]);
    }
    return redirect()->back();
  }
}
