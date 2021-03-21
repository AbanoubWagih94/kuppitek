<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
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
    // Login routes 
    Route::get('/login', function () {
        return view('dashboard.pages.auth.auth');
    });
    Route::post('/login', [AuthController::class, 'login'])->name('dashboard.login');

    Route::middleware(['custom_auth'])->group(function () {
        Route::get('/', function () {
            return view('dashboard.index');
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
        // waiter page
        Route::resource('/waiter', '\App\Http\Controllers\Dashboard\Waiter\WaiterController');
        Route::get('/waiter/add/{order_id}', [WaiterController::class, 'addToKitchen'])->name('waiter.add');
        Route::get('/waiter/serve/{order_id}', [WaiterController::class, 'addToTable'])->name('waiter.toTable');
        Route::delete('/waiter/remove_item/{order_id}', [WaiterController::class, 'removeItemOrder'])->name('waiter.remove.item');

        // kitchen page
        Route::resource('/kitchen', '\App\Http\Controllers\Dashboard\Kitchen\KitchenController');
        Route::get('/kitchen/finish/{order_id}', [KitchenController::class, 'finishOrder'])->name('kitchen.finish');
    });
    // logout route
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::resource('/kuppitek', '\App\Http\Controllers\Website\WebsiteController');
Route::prefix('kuppitek')->group(function () {
    Route::get('/getitem/{id}', '\App\Http\Controllers\Website\WebsiteController@getItem');
    Route::get('/addorder/{id}', '\App\Http\Controllers\WEbsite\WebsiteController@storeItem');
    Route::get('/updatecart/{id}/{qty}', '\App\Http\Controllers\Website\WebsiteController@updateCart');
    Route::get('/deleteitem/{id}', '\App\Http\Controllers\Website\WebsiteController@deleteItem');
});





