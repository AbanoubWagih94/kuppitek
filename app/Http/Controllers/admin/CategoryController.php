<?php

namespace App\Http\Controllers\admin;
use App\Models\MenuCategories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "category";
        $department_name = "category";
        $MenuCategories = MenuCategories::paginate(10);
        return view("admin.pages.category.index", ['MenuCategories'=> $MenuCategories, 'page_name' => $page_name, 'department_name' => $department_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "category";
        $department_name = "category";
        return view("admin.pages.category.add",  ['page_name' => $page_name, 'department_name' => $department_name]);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        MenuCategories::create(['title'=>$request->name]);
        // $request->session()->put('success', 'تمت أضافة القسم بنجاح');
        session()->flash('alert_message', ['message'=>"تم اضافه القسم بنجاح", 'icon'=>'success']);        

        return redirect('/category');
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
       $cat=  MenuCategories::find($id);
       $page_name = "category";
        $department_name = "category";
        return view("admin.pages.category.edit",  [ 'cat'=>$cat , 'page_name' => $page_name, 'department_name' => $department_name]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
       $cat=  MenuCategories::find($id);
        $cat->title = $request->name;
        $cat->save();
        session()->flash('alert_message', ['message'=>"تم تعديل القسم بنجاح", 'icon'=>'success']);        

        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       $cat=  MenuCategories::find($id);
        $cat->delete();
        session()->flash('alert_message', ['message'=>"تم حذف القسم بنجاح", 'icon'=>'error']);        
        return redirect('/category');

    }
}
