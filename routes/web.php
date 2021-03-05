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

// Staff routes
Route::get('/dashboard/staff', [StaffController::class,'index']);
Route::get('/dashboard/staff/add', [StaffController::class,'create']);
Route::post('/dashboard/staff/add', [StaffController::class,'store'])->name('staff.store');
Route::get('/dashboard/staff/edit/{id}', [StaffController::class,'edit']);
Route::put('/dashboard/staff/update/{id}', [StaffController::class,'update'])->name('staff.update');
Route::get('/dashboard/staff/delete/{id}', [StaffController::class,'destroy'])->name('staff.destroy');

// tables routes
Route::get('/dashboard/tables', [TablesControllers::class,'index']);
Route::get('/dashboard/tables/add', [TablesControllers::class,'create']);
Route::post('/dashboard/tables/add', [TablesControllers::class,'store'])->name('table.store');
Route::get('/dashboard/tables/edit/{id}', [TablesControllers::class,'edit']);
Route::put('/dashboard/tables/update/{id}', [TablesControllers::class,'update'])->name('table.update');
Route::get('/dashboard/tables/delete/{id}', [TablesControllers::class,'destroy'])->name('table.destroy');