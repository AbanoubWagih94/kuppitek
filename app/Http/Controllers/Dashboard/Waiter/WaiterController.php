<?php

namespace App\Http\Controllers\Dashboard\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\CounterUsers;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class WaiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $page_name = "waiter_orders";
        $department_name = "waiter_orders";
        $user = User::findOrFail(2);
        
        $orders = [];
        foreach($user->tables as $table) {
            $table_orders = Order::where('table_id', $table->id)->get();
            foreach($table_orders as $table_order){
                $order = $table_order;
                if($order){
                    array_push($orders, $order);
                }
            }
            
        }
        session()->put('user',$user);
        return view('dashboard.pages.waiter.index', ['user'=> $user, 'orders'=> $orders, 'page_name' => $page_name, 'department_name' => $department_name]);
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
    public function show($order_id)
    {
        $page_name = "order_details";
        $department_name = "order_details";
        $order = Order::find($order_id);
        return view('dashboard.pages.waiter.show', ['order'=>$order, 'page_name'=>$page_name, 'department_name'=> $department_name]);

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

    public function addToKitchen($order_id) {
        
        $order = Order::find($order_id);
        $order->order_status = 2;
        $order->save(); 
        session()->flash('alert_message', ['message'=>"Order added to kitchen", 'icon'=>'success']);
        return redirect()->back(); 
    }

    public function showAddToCashier($order_id) {
        $cashiers = User::where('role_id', '2')->get(); 
        return view('dashboard.pages.waiter.add_to_cashier', ['cashiers'=> $cashiers, 'order_id' => $order_id]); 
    }
    public function addToCashier(Request $request, $order_id) {
        $order = Order::find($order_id);
        $cashier = $request->cashier;
        $counter = CounterUsers::where([
            ['user_id', $cashier],
            ['start_money', '!=', null]
        ])->first();
        $order->counter_id = $counter->counter_id;
        $order->save(); 
        session()->flash('alert_message', ['message'=>"Order added to Cashier", 'icon'=>'success']);
        return redirect('dashboard/orders/'. $order_id); 
    }
    public function addToTable($order_id) {
        
        $order = Order::find($order_id);
        $order->order_status = 4;
        $order->save(); 
        session()->flash('alert_message', ['message'=>"Success", 'icon'=>'success']);
        return redirect()->back(); 
    }

    public function removeItemOrder($order_id){
        $order = Order::destroy($order_id);
        if(!$order) {
            session()->flash('alert_message', ['message'=>"Something goes wrong please try again later!", 'icon'=>'error']);
        }
        session()->flash('alert_message', ['message'=>"Success", 'icon'=>'success']);
        return redirect()->route('waiter.index');
    }

}
