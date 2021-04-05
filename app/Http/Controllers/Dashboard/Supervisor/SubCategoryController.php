<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\MenuCategories;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MenuCategories::all();
        return view("dashboard.pages.supervisor.category.sub.add", ['categories' => $categories]);
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
            'title' => 'required',
            'category_id' => 'required'
        ]);
        $sub = SubCategory::create($request->all());
        if (!$sub) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "New sub category added", 'icon' => 'success']);
        return redirect('/dashboard/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub =  SubCategory::find($id);
        return view("dashboard.pages.supervisor.category.sub.show",  ['sub' => $sub]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = MenuCategories::all();
        $sub =  SubCategory::find($id);
        return view("dashboard.pages.supervisor.category.sub.edit",  ['categories' => $categories, 'sub' => $sub]);
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
            'title' => 'required',
            'category_id' => 'required'
        ]);
        $sub =  SubCategory::find($id);
        $sub->update($request->all());
        if (!$sub) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "Sub Category Inforamtion updated", 'icon' => 'success']);

        return redirect('dashboard/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = SubCategory::find($id);
        if ($sub) {
            $sub->delete();
            session()->flash('alert_message', ['message' => "Success", 'icon' => 'success']);
        } else {
            session()->put('error', 'Something goes wrong please try again later');
        }
        return redirect('/dashboard/category');
    }
}
