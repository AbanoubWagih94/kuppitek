<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Cashier\CashierController;
use App\Http\Controllers\Dashboard\Kitchen\KitchenController;
use App\Http\Controllers\Dashboard\Supervisor\CategoryController;
use App\Http\Controllers\Dashboard\Supervisor\CounterController;
use App\Http\Controllers\Dashboard\Supervisor\ProductsController;
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
    
    
    
    Route::middleware(['custom_auth'])->group(function () {
       
       // Login routes 
        Route::post('/login', [AuthController::class, 'login'])->name('dashboard.login');
        Route::get('/login', function () {
            return view('dashboard.pages.auth.auth');
        });
        /** supervisor routes **/
        Route::get('/', function () {
            return view('dashboard.index');
        });

        // customers routes
        Route::resource('/customers', 'App\Http\Controllers\Dashboard\Supervisor\CustomerController');
        // Staff routes
        Route::resource('/staff', 'App\Http\Controllers\Dashboard\Supervisor\StaffController');
        Route::get('/staff/tables/{id}', [StaffController::class, 'createTablesToStaff'])->name('staff.tables.create');
        Route::post('/staff/tables/{id}', [StaffController::class, 'addTablesToStaff'])->name('staff.tables.store');
        Route::get('/staff/counter/{id}', [StaffController::class, 'createCounterToStaff'])->name('staff.counter.create');
        Route::post('/staff/counter/{id}', [StaffController::class, 'addCounterToStaff'])->name('staff.counter.store');

        // orders routes
        Route::resource('supervisor/orders', 'App\Http\Controllers\Dashboard\Supervisor\OrdersController');

        // tables routes
        Route::resource('/tables', 'App\Http\Controllers\Dashboard\Supervisor\TablesController');
        Route::get('/qr-code/{table_number}', function ($table_number) {
            session()->put('table_number', $table_number);
            return QrCode::encoding('UTF-8')->generate(URL::to('/kuppitek/menu/'.$table_number));
        })->name('qrcode');

        // category routes
        Route::resource("/category", "App\Http\Controllers\Dashboard\Supervisor\CategoryController");
        Route::resource("/category/sub", "App\Http\Controllers\Dashboard\Supervisor\SubCategoryController");
        
        
        // products routes
        Route::resource("/products", "App\Http\Controllers\Dashboard\Supervisor\ProductsController");
        Route::get("/products/create/{sub_id}/sub", [ProductsController::class, 'subCategories']);
        
        // tax routes 
        Route::resource("/tax", "App\Http\Controllers\Dashboard\Supervisor\TaxController");
        
        // suppliers routes 
        Route::resource("/supplier", "App\Http\Controllers\Dashboard\Supervisor\SupplierController");
        
        // counter routes
        Route::resource("/counter", "App\Http\Controllers\Dashboard\Supervisor\CounterController");
        route::get('/counter/open/{id}', [CounterController::class, 'showOpenCounterForm'])->name('counter.open.show');
        route::get('/counter/close/{id}', [CounterController::class, 'closeCounterForm'])->name('counter.open.close');
        route::post('/counter/open/{id}', [CounterController::class, 'openCounterForm'])->name('counter.open.store');
        
        /** cashier routes **/ 
        Route::resource('/cashier', '\App\Http\Controllers\Dashboard\Cashier\CashierController');
        Route::get('/cashier/show/orders', [CashierController::class, 'getOrders'])->name('cashier.orders');
        Route::get('/cashier/show/counter', [CashierController::class, 'showCounter'])->name('cashier.counter');
        Route::get('/cashier/print/invoice/{order_id}', [CashierController::class, 'printInvoice'])->name('cashier.invoice');
        
        /** waiter  routes **/
        Route::resource('/waiter', '\App\Http\Controllers\Dashboard\Waiter\WaiterController');
        Route::resource('/orders', '\App\Http\Controllers\Dashboard\Waiter\OrdersController', ['as' => 'waiter']);
        Route::get('/orders/getorders/{table_number}', '\App\Http\Controllers\Dashboard\Waiter\OrdersController@getOrders')->name('waiter.getorders');
        
        Route::get('/waiter/addtowaiter/{order_id}', [WaiterController::class, 'addToKitchen'])->name('waiter.add.kitchen');
        Route::get('/waiter/addtocashier/{order_id}', [WaiterController::class, 'showAddToCashier'])->name('waiter.show.cashier');
        Route::post('/waiter/addtocashier/{order_id}', [WaiterController::class, 'addToCashier'])->name('waiter.add.cashier');
        Route::get('/waiter/serve/{order_id}', [WaiterController::class, 'addToTable'])->name('waiter.toTable');
        Route::delete('/waiter/remove_item/{order_id}', [WaiterController::class, 'removeItemOrder'])->name('waiter.remove.item');

        /** kitchen routes **/ 
        Route::resource('/kitchen', '\App\Http\Controllers\Dashboard\Kitchen\KitchenController');
        Route::get('/kitchen/show/orders', [KitchenController::class, 'getOrders'])->name('kitchen.orders');
        Route::get('/kitchen/accept/order/{order_id}', [KitchenController::class, 'acceptOrder'])->name('kitchen.accept');
        Route::get('/kitchen/finish/product/{order_id}/{product_id}', [KitchenController::class, 'finishProduct'])->name('kitchen.finish');
    });
    // logout route
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::resource('/kuppitek', '\App\Http\Controllers\Website\WebsiteController');
Route::prefix('kuppitek/menu')->group(function () {
    Route::get('/{table_number}', '\App\Http\Controllers\Website\WebsiteController@getMenu')->name('digital.menu');
    Route::get('/show/invoice/{order_id}', '\App\Http\Controllers\Website\WebsiteController@showInvoice')->name('show.invoice');
    Route::get('/getSubCategories/{id}', '\App\Http\Controllers\Website\WebsiteController@getSubCategories');
    Route::get('/getitem/{id}/{type}', '\App\Http\Controllers\Website\WebsiteController@getItem');
    Route::get('/addorder/{id}', '\App\Http\Controllers\Website\WebsiteController@storeItem');
    Route::get('/updatecart/{id}/{qty}', '\App\Http\Controllers\Website\WebsiteController@updateCart');
    Route::get('/deleteitem/{id}', '\App\Http\Controllers\Website\WebsiteController@deleteItem');
});
