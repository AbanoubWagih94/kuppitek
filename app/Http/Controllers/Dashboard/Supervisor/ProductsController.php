<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\MenuCategories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view("dashboard.pages.supervisor.products.index", ['products'=> $products,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MenuCategories::all();
        return view('dashboard.pages.supervisor.products.add', ['categories'=> $categories]);
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
            'title' => 'required|max:150|unique:products',
            'category_id' => 'required',
            'cost_price' => 'required',
            'selling_price' => 'required',
            'ingredients' => 'required'
        ]);
        $image = "";
        if ($request->hasFile('image')) {
            $image = time() . $request->image->getClientOriginalName() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/uploads/images/products'), $image);
        }
        $product = Product::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'quantity' => 1,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'ingredients' => $request->ingredients,
            'image_path' => $image
        ]);

        if (!$product) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "New product added", 'icon' => 'success']);
        return redirect('/dashboard/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('dashboard.pages.supervisor.products.show', ['product'=> $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = MenuCategories::all();
        return view('dashboard.pages.supervisor.products.edit', ['product' => $product, 'categories' => $categories]);
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
            'title' => 'required|max:150|',
            'category_id' => 'required',
            'cost_price' => 'required',
            'selling_price' => 'required',
            'ingredients' => 'required'
        ]);
        $product = Product::find($id);
        $image = $product->image_path;
        if ($request->hasFile('image')) {
            if ($image!="" && file_exists(public_path(('assets/uploads/images/staff/products' . $image)))) {
                unlink(public_path(('assets/uploads/images/products/'.$image)));
            }
            $image = time() . $request->image->getClientOriginalName() . '.' . $request->image->extension();
            $request->image->move(public_path('assets/uploads/images/products'), $image);
        }

        $product = $product->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'ingredients' => $request->ingredients,
            'image_path' => $image
        ]);

        if (!$product) {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later!", 'icon' => 'error']);

            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "Product information updated", 'icon' => 'success']);
        return redirect('/dashboard/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            session()->flash('alert_message', ['message' => "Success", 'icon' => 'success']);
        } else {
            session()->put('error', 'Something goes wrong please try again later');
        }
        return redirect('/dashboard/products');
    }
}
