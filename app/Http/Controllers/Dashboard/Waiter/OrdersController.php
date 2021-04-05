<?php

namespace App\Http\Controllers\Dashboard\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = session('userLogin');
        $tables = $user->tables;
        return view('dashboard.pages.waiter.orders', ['tables' => $tables]);
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
        return view('dashboard.pages.waiter.show', ['order'=> $order]);
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
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            session()->flash('alert_message', ['message' => "success", 'icon' => 'success']);
        } else {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'error']);
        }
        return redirect('/dashboard/orders');
    }

    public function getOrders($table_number)
    {
        $table = Table::where('table_number', $table_number)->first();
        $orders = Order::where([
            ['table_id', $table->id],
            ['created_at', '>', Carbon::today()],
            ['order_status', '<=', 4]
        ])->get();
        $html = '';
        if ($orders->count() > 0) {
            foreach ($orders as $key => $order) {
                $html .=
                    "<tr>
                    <td>$order->id</td>
                    <td>ِ $table_number </td>
                    <td>ِ";
                if ($order->order_status == 1) {
                    $html .= "Order not served";
                } else if ($order->order_status == 2) {
                    $html .= "Order in kitchen now";
                } else if ($order->order_status == 3) {
                    $html .= "Order accepted in kitchen";
                } else if ($order->order_status == 4) {
                    $html .= "Order served to table";
                } 
                $html .= "</td><td>
                        <a href='" .route('waiter.orders.show', $order->id )."' class='btn btn-sm round btn-warning'><i class='fas fa-eye'></i></a>
                                        <form action='" .route('waiter.orders.destroy', $order->id )."' method='post'>
                                               " . csrf_field() .
                    method_field('delete') . "
                                                <button class='btn btn-sm round btn-danger' onclick='return confirm('Do you want to remove this order?!')'><i class='fas fa-trash-alt'></i></button>
                                            </form>
                        </td>
                </tr>";
            }
        } else {
            $html = '<tr class="text-center"><td colspan="3">No Orders Found</td></tr>';
        }
        return response()->json(['html' => $html]);
    }
}
