<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Table;
use App\Models\User;
use App\Models\UserTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "staff";
        $department_name = "staff";
        $users = User::all();
        return view('dashboard.pages.supervisor.staff.index', ['users'=> $users, 'page_name' => $page_name, 'department_name' => $department_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "add";
        $department_name = "add_staff";
        $roles = Role::all();
        $tables = Table::all();
        return view('dashboard.pages.supervisor.staff.add', ['roles'=> $roles, 'tables'=> $tables, 'page_name' => $page_name, 'department_name' => $department_name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = Hash::make("123456");
        $request->validate([
            'user_name'=>'required|max:150|unique:users',
            'name'=>'required|max:150',
            'role_id'=>'required',
        ]);

        $user = User::create([
            'role_id' => $request->role_id,
            'user_name'=> $request->user_name,
            'name'=> $request->name,
            'password' => $password
        ]);

        if (!$user) {
            session()->flash('alert_message', ['message'=>"something goes wrong", 'icon'=>'error']);
            return redirect()->back();
        }
        session()->flash('alert_message', ['message'=>"success", 'icon'=>'success']);
        return redirect('/dashboard/staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_name = "show";
        $department_name = "show_staff";
        $user = User::find($id);
        return view('dashboard.pages.supervisor.staff.show', ['user'=> $user, 'page_name'=> $page_name, 'department_name'=> $department_name]);
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
        $department_name = "edit_staff";
        $roles = Role::all();
        $user = User::find($id);
        return view('dashboard.pages.supervisor.staff.edit', ['user'=> $user, 'roles'=> $roles,  'page_name'=> $page_name, 'department_name'=> $department_name]);
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
            'name'=>'required|max:150',
            'role_id'=>'required',
        ]);
        $user = User::find($id);    
        $user = $user->update([
            'role_id' => $request->role_id,
            'name'=> $request->name,
        ]);

        if (!$user) {
            session()->flash('alert_message', ['message'=>"something goes wrong", 'icon'=>'error']);
                
            return redirect()->back();
        }
        session()->flash('alert_message', ['message'=>"success", 'icon'=>'success']);
        return redirect('/dashboard/staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user) {
            $user->delete();
            session()->flash('alert_message', ['message'=>"Success", 'icon'=>'success']);
        } else {
            session()->put('error', 'Something goes wrong please try again later');
        }
        return redirect('/dashboard/staff');
    }

    public function createTablesToStaff($id){
        $page_name = "edit";
        $department_name = "edit_staff";
        $user = User::findOrFail($id);
        $tables = Table::all();
        return view('dashboard.pages.supervisor.staff.add_tables', ['user'=> $user,'tables'=> $tables,  'page_name'=> $page_name, 'department_name'=> $department_name]);
    }

    public function addTablesToStaff(Request $request, $user_id){
        $request->validate([
            'tables' => 'required',
        ]);
        $tables = $request->tables;    

        if (!$tables) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        } else {
            foreach ($tables as $table) {
                UserTables::create([
                    'user_id' => $user_id,
                    'table_id' => $table
                ]);
            }
            session()->flash('alert_message', ['message' => "success", 'icon' => 'success']);
        }
        

        return redirect('/dashboard/tables');
    }
}
