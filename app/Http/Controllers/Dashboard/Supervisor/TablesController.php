<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "tables";
        $department_name = "tables";
        $tables = Table::all();
        return view('dashboard.pages.supervisor.tables.index', ['tables' => $tables, 'page_name' => $page_name, 'department_name' => $department_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "add";
        $department_name = "add_table";
        $role = Role::where('title', 'waiter')->first();

        return view('dashboard.pages.supervisor.tables.add', ['users' => $role->users, 'page_name' => $page_name, 'department_name' => $department_name]);
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
            'table_number' => 'required|unique:tables',
        ]);

        $table = Table::create([
            'table_number' => $request->table_number,
            'table_status' => 0
        ]);

        if (!$table) {
            session()->flash('alert_message', ['message' => "something goes wrong", 'icon' => 'error']);
            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "success", 'icon' => 'success']);

        return redirect('/dashboard/tables');
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
        $page_name = "edit";
        $department_name = "edit_table";
        $table = Table::find($id);

        return view('dashboard.pages.supervisor.tables.edit', ['table' => $table, 'page_name' => $page_name, 'department_name' => $department_name]);
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
        $table = Table::find($id);

        if (!$table) {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again!", 'icon' => 'error']);;
            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "success", 'icon' => 'success']);


        return redirect('/dashboard/tables');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);
        if ($table) {
            $table->delete();
            session()->flash('alert_message', ['message' => "success", 'icon' => 'success']);
        } else {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'error']);
        }
        return redirect('/dashboard/tables');
    }
}
