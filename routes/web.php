<?php

// use App\Http\Controllers\admin\KitchenController;
// use App\Http\Controllers\admin\OrdersController;
// use App\Http\Controllers\admin\TablesControllers;
// use App\Http\Controllers\admin\UserController;
// use App\Http\Controllers\admin\WaiterOrders;

use App\Http\Controllers\Dashboard\Kitchen\KitchenController;
use App\Http\Controllers\Dashboard\Supervisor\StaffController;
use App\Http\Controllers\Dashboard\Waiter\WaiterController;
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

Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        $department_name = 'dashboard';
        $page_name = 'dashboard';
        return view('dashboard.index', compact('department_name', 'page_name'));
    });

    // Staff routes
    Route::resource('/staff', 'App\Http\Controllers\Dashboard\Supervisor\StaffController');
    Route::get('/staff/tables/{id}', [StaffController::class, 'createTablesToStaff'])->name('staff.tables.create');
    Route::post('/staff/tables/{id}', [StaffController::class, 'addTablesToStaff'])->name('staff.tables.store');

    // orders routes
    Route::resource('/orders', 'App\Http\Controllers\Dashboard\Supervisor\OrdersController');

    // tables routes
    Route::resource('/tables', 'App\Http\Controllers\Dashboard\Supervisor\TablesController');
    Route::get('/qr-code/{table_number}', function ($table_number) {
        return QrCode::encoding('UTF-8')->generate(URL::to('/landpage?' . $table_number));
    })->name('qrcode');

    // category routes
    Route::resource("/category", "App\Http\Controllers\Dashboard\Supervisor\CategoryController");

    // items routes
    Route::resource("/menuitem", "App\Http\Controllers\Dashboard\Supervisor\MenuItemController");
});

// waiter page
Route::resource('/waiter', '\App\Http\Controllers\Dashboard\Waiter\WaiterController');
Route::get('/waiter/add/{order_id}', [WaiterController::class, 'addToKitchen'])->name('waiter.add');
Route::get('/waiter/serve/{order_id}', [WaiterController::class, 'addToTable'])->name('waiter.toTable');
Route::delete('/waiter/remove_item/{order_id}', [WaiterController::class, 'removeItemOrder'])->name('waiter.remove.item');

// kitchen page
Route::resource('/kitchen', '\App\Http\Controllers\Dashboard\Kitchen\KitchenController');
Route::get('/kitchen/finish/{order_id}', [KitchenController::class, 'finishOrder'])->name('kitchen.finish');




/*Route::get('/', function () {
    $department_name = 'login';
    $page_name = 'login';
    return view('admin.pages.users.login', compact('department_name', 'page_name'));
});*/


// user routes
//Route::resource('/users', '\App\Http\Controllers\admin\UserController');
//Route::post('users/login', [UserController::class, 'login'])->name('user.login');



// order Page
Route::get("/order", "\App\Http\Controllers\admin\CartController@index");

Route::get('/addorder/{id}', '\App\Http\Controllers\admin\CartController@storeCart');
Route::get('/allorder', '\App\Http\Controllers\admin\CartController@order');
Route::post('/allorder/{table_number}', '\App\Http\Controllers\admin\CartController@saveOrder');
Route::get('/clearCart', '\App\Http\Controllers\admin\CartController@clearCart');
Route::get('/deleteItemCart/{id}', '\App\Http\Controllers\admin\CartController@deleteItemCart')->name('cart.delete.item');
// Auth::routes();
Route::get('/getitem', '\App\Http\Controllers\admin\CartController@getitem');
Route::get('/landpage', '\App\Http\Controllers\admin\CartController@landpage');





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
