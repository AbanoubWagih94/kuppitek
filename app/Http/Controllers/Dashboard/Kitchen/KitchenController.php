<?php

namespace App\Http\Controllers\Dashboard\Kitchen;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItems;
use Carbon\Carbon;
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
        return view('dashboard.pages.kitchen.index');
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
        $order = Order::find($order_id);
        return view('dashboard.pages.kitchen.show', ['order' => $order]);
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


    public function getOrders()
    {
        $orders = Order::where([
            ['order_status', '<=', 3],
            ['created_at', '>', Carbon::today()]
        ])->get();
        return view('dashboard.pages.kitchen.orders', ['orders' => $orders]);
    }

    public function acceptOrder($order_id)
    {
        $order = Order::find($order_id);
        $order->order_status = 3;
        $order->save();
        session()->flash('alert_message', ['message' => "Order Accepted", 'icon' => 'success']);
        return redirect()->back();
    }

    public function finishProduct($order_id, $product_id)
    {
        $item = OrderItems::where(
            [
                ['order_id', $order_id],
                ['product_id', $product_id]
            ]
        )->first();
        $item->item_status = true;
        $item->save();
        if ($item) {
            $items = OrderItems::where([
                ['order_id', $order_id],
                ['item_status', false]
            ])->get();
            if ($items->count() < 1) {
                $order = Order::find($order_id);
                $order->order_status = 4;
                $order->save();
                if ($order) {
                    session()->flash('alert_message', ['message' => "This Order If Finished", 'icon' => 'success']);
                    return redirect('dashboard/kitchen/show/orders');
                }
                session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'success']);
            }
            session()->flash('alert_message', ['message' => "This Item Served", 'icon' => 'success']);
        } else {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'success']);
        }
        return redirect()->back();
    }
}
