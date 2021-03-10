<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;
use App\Models\User;
use App\Models\UserTables;
use Illuminate\Http\Request;

class WaiterOrders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {  
        $page_name = "waiter_orders";
        $department_name = "waiter_orders";
        $user = User::findOrFail($id);
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
        return view('admin.pages.waiter_orders.index', ['user'=> $user, 'orders'=> $orders, 'page_name' => $page_name, 'department_name' => $department_name]);
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
        return view('admin.pages.waiter_orders.show', ['order'=>$order, 'page_name'=>$page_name, 'department_name'=> $department_name]);

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
        session()->flash('alert_message', ['message'=>"تم أضافة الطلب إلى المطبخ", 'icon'=>'success']);
        return redirect()->back(); 
    }
    public function addToTable($order_id) {
        
        $order = Order::find($order_id);
        $order->order_status = 4;
        $order->save(); 
        session()->flash('alert_message', ['message'=>"الطلب الأن على الطاولة", 'icon'=>'success']);
        $user = session('user');
        return redirect()->route('kitchen.index', $user->id); 
    }

}
