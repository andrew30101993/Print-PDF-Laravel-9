<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\InvoicesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route(route: 'home.index');
    } else {
        return view('admin.login');
    }
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('home', HomeController::class);
    Route::resource('productlist', ProductsController::class);
    Route::resource('customers', CustomersController::class);
    Route::resource('invoices', InvoicesController::class);


    Route::get('/productlist/{id}', [ProductsController::class]);

});