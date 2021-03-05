<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
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
        return view('admin.pages.staff.index', ['users'=> $users, 'page_name' => $page_name, 'department_name' => $department_name]);
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
        return view('admin.pages.staff.add', ['roles'=> $roles,'page_name' => $page_name, 'department_name' => $department_name]);
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
            $request->session()->put('error', 'حدث خطأ ما حاول مره اخرى!');
            return redirect()->back();
        }
        $request->session()->put('success', 'تمت أضافة الموظف بنجاح');
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
        $department_name = "edit_staff";
        $roles = Role::all();
        $user = User::find($id);
        return view('admin.pages.staff.edit', ['user'=> $user, 'roles'=> $roles, 'page_name'=> $page_name, 'department_name'=> $department_name]);
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
            $request->session()->put('error', 'حدث خطأ ما حاول مره اخرى!');
            return redirect()->back();
        }
        $request->session()->put('success', 'تمت تعديل بيانات الموظف بنجاح');
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
            session()->put('success', 'تمت حذف بيانات الموظف بنجاح');
        } else {
            session()->put('error', 'حدث خطأ ما حاول مرة اخرى');
        }
        return redirect('/dashboard/staff');
    }
}
