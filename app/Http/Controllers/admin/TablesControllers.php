<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\Role;
use App\Models\UserTables;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;

class TablesControllers extends Controller
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
        return view('admin.pages.tables.index', ['tables'=> $tables, 'page_name' => $page_name, 'department_name' => $department_name]);

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
        $role = Role::where('title', 'نادل')->first();
        
        return view('admin.pages.tables.add', ['users'=> $role->users,'page_name' => $page_name, 'department_name' => $department_name]);

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
            'table_number'=>'required|unique:tables',
            'users'=>'required',
        ]);

        $table = Table::create([
            'table_number' => $request->table_number,
            'table_status'=> 0
        ]);

        if (!$table) {
            $request->session()->put('error', 'حدث خطأ ما حاول مره اخرى!');
            return redirect()->back();
        } else {
            foreach($request->users as $user) {
                UserTables::create([
                    'user_id'=> $user,
                    'table_id'=> $table->id
                ]);
            }
        $request->session()->put('success', 'تمت أضافة الطاولة بنجاح');
        }   
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
        $users_ids = [];
        $role = Role::where('title', 'نادل')->first();
        $users = $role->users;
        $table = Table::find($id);
         foreach($table->users as $user){
            array_push($users_ids, $user->id);
         }
        return view('admin.pages.tables.edit', ['table'=> $table, 'users'=> $users, 'users_ids'=> $users_ids,'page_name'=> $page_name, 'department_name'=> $department_name]);
    
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
            'users'=>'required',
        ]);
        $table = Table::find($id);    

        if (!$table) {
            $request->session()->put('error', 'حدث خطأ ما حاول مره اخرى!');
            return redirect()->back();
        } else {
            foreach($request->users as $user) {
                $findUser = UserTables::where('user_id', $user)->first();
                
                if(!$findUser) {
                    UserTables::create([
                        'user_id'=> $user,
                        'table_id'=> $table->id
                    ]);
                } 
            }
        $request->session()->put('success', 'تمت تعديل بيانات الطاولة بنجاح');
        } 
        
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
        if($table) {
            $table->delete();
            session()->put('success', 'تمت حذف الطاولة بنجاح');
        } else {
            session()->put('error', 'حدث خطأ ما حاول مرة اخرى');
        }
        return redirect('/dashboard/tables');
    
    }
}
