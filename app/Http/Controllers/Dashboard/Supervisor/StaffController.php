<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\CounterUsers;
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
        return view('dashboard.pages.supervisor.staff.index', ['users' => $users, 'page_name' => $page_name, 'department_name' => $department_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $tables = Table::all();
        return view('dashboard.pages.supervisor.staff.add', ['roles' => $roles, 'tables' => $tables]);
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
            'email' => 'required|max:150|unique:users',
            'name' => 'required|max:150',
            'role_id' => 'required',
            'country_id' => 'required',
            'phone_number' => 'required',
            'image'=> 'required'
        ]);
        $image = "";
        if ($request->hasFile('image')) {
            $image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('assets/uploads/images/staff'), $image);
        }
        $user = User::create([
            'role_id' => $request->role_id,
            'email' => $request->email,
            'name' => $request->name,
            'password' => $password,
            'country_id' => $request->country_id,
            'mobile_number' => $request->phone_number,
            'image_path' => $image
        ]);

        if (!$user) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "New member added", 'icon' => 'success']);
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
        $user = User::find($id);
        return view('dashboard.pages.supervisor.staff.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view('dashboard.pages.supervisor.staff.edit', ['user' => $user, 'roles' => $roles,]);
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
            'name' => 'required|max:150',
            'role_id' => 'required',
            'country_id' => 'required',
            'phone_number' => 'required',
        ]);
        $user = User::find($id);


        $image = $user->image_path;
        if ($request->hasFile('image')) {
            if ($image!="" && file_exists(public_path(('assets/uploads/images/staff/' . $image)))) {
                unlink(public_path(('assets/uploads/images/staff/'.$image)));
            }
            $image = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('assets/uploads/images/staff'), $image);
        }

        $user = $user->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'country_id' => $request->country_id,
            'mobile_number' => $request->phone_number,
            'image_path' => $image
        ]);

        if (!$user) {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later!", 'icon' => 'error']);

            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "Member information updated", 'icon' => 'success']);
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
        if ($user) {
            $user->delete();
            session()->flash('alert_message', ['message' => "Success", 'icon' => 'success']);
        } else {
            session()->put('error', 'Something goes wrong please try again later');
        }
        return redirect('/dashboard/staff');
    }

    public function createTablesToStaff($id)
    {
        $user = User::findOrFail($id);
        $tables = Table::all();
        return view('dashboard.pages.supervisor.staff.add_tables', ['user' => $user, 'tables' => $tables]);
    }

    public function addTablesToStaff(Request $request, $user_id)
    {
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
    public function createCounterToStaff($id)
    {
        $user = User::findOrFail($id);
        $counters = Counter::all();
        return view('dashboard.pages.supervisor.staff.add_counter', ['user' => $user, 'counters' => $counters]);
    }

    public function addCounterToStaff(Request $request, $user_id)
    {
        $request->validate([
            'counter_id' => 'required',
        ]);
        $counter = $request->counter_id;

        if (!$counter) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        } else {
            
                CounterUsers::create([
                    'counter_id'=> $request->counter_id,
                    'user_id'=> $user_id,
                    'start_money'=> " "
                ]);
            
            session()->flash('alert_message', ['message' => "success", 'icon' => 'success']);
        }


        return redirect('/dashboard/counter');
    }
}
