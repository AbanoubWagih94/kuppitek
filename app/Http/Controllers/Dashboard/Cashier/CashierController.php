<?php

namespace App\Http\Controllers\Dashboard\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\CounterUsers;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.cashier.index');
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
        $order = Order::find($id);
        return view('dashboard.pages.cashier.show', ['order' => $order]);
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

    public function showCounter() {
        $user = session('userLogin');
        $counter_user = CounterUsers::where([
            ['user_id', $user->id],
        ])->first(); 
        
        $counter = Counter::find($counter_user->counter_id);
        $users = $counter->users;
        return view('dashboard.pages.cashier.counter', ['counter' => $counter, 'users'=> $users]);
    }

    public function getOrders()
    {
        $user = session('userLogin');
        $counter = CounterUsers::where([
            ['user_id', $user->id],
            ['start_money', '!=', null]
        ])->first();
        $orders = Order::where(
            [
                ['counter_id', $counter->counter_id],
                ['order_status', '<=', 4],
                ['created_at', '>', Carbon::today()]
            ]
        )->get();

        return view('dashboard.pages.cashier.orders', ['orders' => $orders]);
    }

    public function printInvoice($order_id) {
        $order = Order::find($order_id);
        $order->order_status = 5 ;
        $order->save();
        if(!$order) {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'error']);
            return redirect()->back();
        }
        $customer = Customer::find($order->customer_id);
        if (!$customer) {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'error']);
            return redirect()->back();
        } 
        session()->flash('alert_message', ['message' => "You printed invoice of order number: ". $order_id."#" , 'icon' => 'success']);
            return redirect()->back();
    }

    
}
