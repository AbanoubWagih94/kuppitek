<?php

use App\Http\Controllers\admin\StaffController;
use App\Http\Controllers\admin\TablesControllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $department_name='dashboard';
    $page_name='dashboard';
    return view('/admin/dashboard' , compact('department_name' , 'page_name'));
});

// Admin routes 

Route::get('/dashboard/staff', [StaffController::class,'index']);
Route::get('/dashboard/staff/add', [StaffController::class,'create']);
Route::post('/dashboard/staff/add', [StaffController::class,'store'])->name('staff.store');
Route::get('/dashboard/staff/edit/{id}', [StaffController::class,'edit']);
Route::put('/dashboard/staff/update/{id}', [StaffController::class,'update'])->name('staff.update');
Route::get('/dashboard/staff/delete/{id}', [StaffController::class,'destroy'])->name('staff.destroy');

Route::resource("category","\App\Http\Controllers\admin\CategoryController");
Route::resource("menuitem","\App\Http\Controllers\admin\MenuItemController");



// tables routes
Route::get('/dashboard/tables', [TablesControllers::class,'index']);
Route::get('/dashboard/tables/add', [TablesControllers::class,'create']);
Route::post('/dashboard/tables/add', [TablesControllers::class,'store'])->name('table.store');
Route::get('/dashboard/tables/edit/{id}', [TablesControllers::class,'edit']);
Route::put('/dashboard/tables/update/{id}', [TablesControllers::class,'update'])->name('table.update');
Route::get('/dashboard/tables/delete/{id}', [TablesControllers::class,'destroy'])->name('table.destroy');
Route::resource("category","\App\Http\Controllers\admin\CategoryController");
Route::resource("menuitem","\App\Http\Controllers\admin\MenuItemController");
Route::get("/order","\App\Http\Controllers\admin\CartController@index");

Route::get('/addorder/{id}', '\App\Http\Controllers\admin\CartController@storeCart');
Route::get('/allorder', '\App\Http\Controllers\admin\CartController@order');
Route::post('/allorder', '\App\Http\Controllers\admin\CartController@saveOrder');
Route::get('/clearCart', '\App\Http\Controllers\admin\CartController@clearCart');
Route::post('/deleteItemCart', '\App\Http\Controllers\admin\CartController@deleteItemCart');
// Auth::routes();
Route::get('/getitem', '\App\Http\Controllers\admin\CartController@getitem');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
