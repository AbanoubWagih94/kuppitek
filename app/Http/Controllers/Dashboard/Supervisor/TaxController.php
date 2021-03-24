<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxs  = Tax::all();
        return view('dashboard.pages.supervisor.tax.index', ['taxs'=> $taxs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.supervisor.tax.add');
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
            'tax_percentage' => 'required|unique:taxes'
        ]);
        $tax = Tax::where('tax_applied', true)->first();
        if($tax && $request->tax_applied == "on") {
            session()->flash('alert_message', ['message' => "There is another tax applied please remove it first", 'icon' => 'error']);
            return redirect()->back();
        } else {
            $tax = Tax::create([
                'tax_percentage' => $request->tax_percentage,
                'tax_applied' =>  $request->tax_applied == "on" ? true : false
            ]);
            if (!$tax) {
                session()->flash('alert_message', ['message' => "Something goes wrong please try again later", 'icon' => 'error']);
                return redirect()->back();
            }
        }
        session()->flash('alert_message', ['message' => "New tax added", 'icon' => 'success']);
        return redirect('dashboard/tax');
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
        $tax = Tax::find($id);
        return view('dashboard.pages.supervisor.tax.edit', ['tax' => $tax]);
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
        $tax = Tax::find($id);
        $request->validate([
            'tax_percentage' => 'required'
        ]);
        $applied_tax = Tax::where('tax_applied', true)->first();
        if($applied_tax && $tax->tax_applied == false) {
            session()->flash('alert_message', ['message' => "There is another tax applied please remove it first", 'icon' => 'error']);
            return redirect()->back();
        } else {
            $tax = $tax->update([
                'tax_percentage' => $request->tax_percentage,
                'tax_applied' =>  $request->tax_applied == "on" ? true : false
            ]);
            if (!$tax) {
                session()->flash('alert_message', ['message' => "Something goes wrong please try again later", 'icon' => 'error']);
                return redirect()->back();
            }
        }
        session()->flash('alert_message', ['message' => "Success", 'icon' => 'success']);
        return redirect('dashboard/tax');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Tax::find($id);
        if ($tax) {
            $tax->delete();
            session()->flash('alert_message', ['message' => "Success", 'icon' => 'success']);
        } else {
            session()->put('error', 'Something goes wrong please try again later');
        }
        return redirect('/dashboard/tax');
    }
}
