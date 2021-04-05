<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\Supplier;
use App\Models\SuppliersPayments;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('dashboard.pages.supervisor.suppliers.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payments = Payments::all();
        return view('dashboard.pages.supervisor.suppliers.add', ['payments' => $payments]);
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
            'name' => 'required|unique:suppliers',
            'phone_number' => 'required',
            'address' => 'required',
            'payment_methods' => 'required'
        ]);

        $supplier = Supplier::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);
        $payments = $request->payment_methods;
        if (!$supplier) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        } else {
            foreach ($payments as $payment) {
                SuppliersPayments::create([
                    'supplier_id' => $supplier->id,
                    'payment_id' => $payment
                ]);
            }
        }
        session()->flash('alert_message', ['message' => "New Supplier added", 'icon' => 'success']);

        return redirect('/dashboard/supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('dashboard.pages.supervisor.suppliers.show', ['supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payments = Payments::all(); 
        $supplier = Supplier::find($id);
        $payment_ids = [];
        foreach($supplier->payments as $payment) {
            array_push($payment_ids, $payment->id);
        }
        return view('dashboard.pages.supervisor.suppliers.edit', ['supplier' => $supplier, 'payments' => $payments, 'payment_ids' => $payment_ids]);
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
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'payment_methods' => 'required'
        ]);

        $supplier = Supplier::find($id);
        if (!$supplier) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        } else {
            $supplier->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address
            ]);
            $payments = $request->payment_methods;
            $supplier_payments = $supplier->payments;
            foreach ($supplier_payments as $pay) {
                if (!in_array($pay->id, $payments)) {
                    SuppliersPayments::destroy($pay->pivot->id);
                }
            }
            foreach ($payments as $payment_id) {
                $payment = SuppliersPayments::where('payment_id', $payment_id)->first();
                
                if (!$payment) {
                    SuppliersPayments::create([
                        'supplier_id' => $supplier->id,
                        'payment_id' => $payment_id
                    ]);
                } else if ($payment->supplier_id != $supplier->id) {
                    SuppliersPayments::create([
                        'supplier_id' => $supplier->id,
                        'payment_id' => $payment_id
                    ]);
                }
            }
        }
        session()->flash('alert_message', ['message' => "New supplier updated", 'icon' => 'success']);

        return redirect('/dashboard/supplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->delete();
            session()->flash('alert_message', ['message' => "success", 'icon' => 'success']);
        } else {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'error']);
        }
        return redirect('/dashboard/suppliers');
    }
}
