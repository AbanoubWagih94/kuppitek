<?php

// use App\Http\Controllers\admin\KitchenController;
// use App\Http\Controllers\admin\OrdersController;
// use App\Http\Controllers\admin\TablesControllers;
// use App\Http\Controllers\admin\UserController;
// use App\Http\Controllers\admin\WaiterOrders;

use App\Http\Controllers\Dashboard\Supervisor\StaffController;
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

/*Route::get('/', function () {
    $department_name = 'login';
    $page_name = 'login';
    return view('admin.pages.users.login', compact('department_name', 'page_name'));
});*/

Route::get('/', function () {
    $department_name = 'dashboard';
    $page_name = 'dashboard';
    return view('dashboard.index', compact('department_name', 'page_name'));
});

// Admin routes 

// Staff routes
Route::resource('/dashboard/staff', 'App\Http\Controllers\Dashboard\Supervisor\StaffController');
Route::get('/dashboard/staff/tables/{id}', [StaffController::class, 'createTablesToStaff'])->name('staff.tables.create');
Route::post('/dashboard/staff/tables/{id}', [StaffController::class, 'addTablesToStaff'])->name('staff.tables.store');

// orders routes

Route::resource('/dashboard/orders', 'App\Http\Controllers\Dashboard\Supervisor\OrdersController');

// tables routes
Route::resource('/dashboard/tables', 'App\Http\Controllers\Dashboard\Supervisor\TablesController');

// category routes
Route::resource("category", "App\Http\Controllers\Dashboard\Supervisor\CategoryController");

// items routes
Route::resource("menuitem", "App\Http\Controllers\Dashboard\Supervisor\MenuItemController");
// user routes
Route::resource('/users', '\App\Http\Controllers\admin\UserController');
Route::post('users/login', [UserController::class, 'login'])->name('user.login');

// waiter_orders page
Route::get('/waiter_orders/{id}', [WaiterOrders::class, 'index'])->name('waiter.index');
Route::get('/waiter_orders/show/{order_id}', [WaiterOrders::class, 'show'])->name('waiter.show');
Route::get('/waiter_order/add/{order_id}', [WaiterOrders::class, 'addToKitchen'])->name('waiter.add');
Route::get('/waiter_order/serve/{order_id}', [WaiterOrders::class, 'addToTable'])->name('waiter.toTable');

// kitchen page
Route::get('/kitchen', [KitchenController::class, 'index'])->name('kitchen.index');
Route::get('/kitchen/show/{order_id}', [KitchenController::class, 'show'])->name('kitchen.show');
Route::get('/waiter_order/finish/{order_id}', [KitchenController::class, 'finishOrder'])->name('kitchen.finish');


// order Page
Route::get("/order","\App\Http\Controllers\admin\CartController@index");

Route::get('/addorder/{id}', '\App\Http\Controllers\admin\CartController@storeCart');
Route::get('/allorder', '\App\Http\Controllers\admin\CartController@order');
Route::post('/allorder/{table_number}', '\App\Http\Controllers\admin\CartController@saveOrder');
Route::get('/clearCart', '\App\Http\Controllers\admin\CartController@clearCart');
Route::get('/deleteItemCart/{id}', '\App\Http\Controllers\admin\CartController@deleteItemCart')->name('cart.delete.item');
// Auth::routes();
Route::get('/getitem', '\App\Http\Controllers\admin\CartController@getitem');
Route::get('/landpage', '\App\Http\Controllers\admin\CartController@landpage');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/qr-code', function () 
{
    return QrCode::encoding('UTF-8')->generate(URL::to('/landpage?2'));
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
