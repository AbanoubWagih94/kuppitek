<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItems;
use App\Models\MenuCategories;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "menu";
        $department_name = "menu";
        $MenuItems = MenuItems::paginate(10);
        return view("dashboard.pages.supervisor.item.index", ['MenuItems'=> $MenuItems, 'page_name' => $page_name, 'department_name' => $department_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "menu";
        $department_name = "menu";
        $MenuCategories = MenuCategories::get();

        return view("dashboard.pages.supervisor.item.add",  [  'MenuCategories'=> $MenuCategories, 'page_name' => $page_name, 'department_name' => $department_name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MenuItems::create([
            'title'=>$request->name,
            'category_id'=>$request->category_id,
            'cost'=>$request->cost,
            ]);
        session()->flash('alert_message', ['message'=>"Success", 'icon'=>'success']);        

        return redirect('dashboard/menuitem');
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
        $MenuCategories = MenuCategories::get();

        $menu=  MenuItems::find($id);
       $page_name = "category";
        $department_name = "category";
        return view("dashboard.pages.supervisor.item.edit",  [  'MenuCategories'=> $MenuCategories, 'menu'=>$menu , 'page_name' => $page_name, 'department_name' => $department_name]);
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
        $menu=  MenuItems::find($id);
        $menu->title = $request->name;
        $menu->category_id = $request->category_id;
        $menu->cost = $request->cost;
        $menu->save();
        session()->flash('alert_message', ['message'=>"Success", 'icon'=>'success']);        

        return redirect('dashboard/menuitem');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu=  MenuItems::find($id);
        $menu->delete();
        session()->flash('alert_message', ['message'=>"Success", 'icon'=>'success']);        
        return redirect('dashboard/menuitem');
    }
}
