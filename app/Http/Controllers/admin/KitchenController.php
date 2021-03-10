<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "kitchen";
        $department_name = "kitchen";
        $orders = Order::where('order_status', 2)->get();
        return view('admin.pages.kitchen.index', ['orders'=> $orders, 'page_name' => $page_name, 'department_name' => $department_name]);
    
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
        return view('admin.pages.kitchen.show', ['order'=>$order, 'page_name'=>$page_name, 'department_name'=> $department_name]);
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

    public function finishOrder($order_id) {
        $order = Order::find($order_id);
        $order->order_status = 3 ;
        $order->save();
        session()->flash('alert_message', ['message'=>"تم تجهيز الطلب", 'icon'=>'success']);
        return redirect('/kitchen'); 
    }
}
