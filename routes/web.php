<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PdfController;

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
    return view('auth.login');
});

Auth::routes();


Route::group(['middleware'=>'auth'],function(){
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/customer_data', [App\Http\Controllers\ContactsController::class, 'customer_data'])->name('customer_data');
Route::get('/supplier', [App\Http\Controllers\ContactsController::class, 'supplier'])->name('supplier');
Route::post('/add-customer', [App\Http\Controllers\ContactsController::class, 'store'])->name('/add-customer');
Route::resource('contcats','ContactsController');
Route::post('/edit_contcats_data/{id}', [App\Http\Controllers\ContactsController::class, 'edit'])->name('edit_contcats_data');
Route::post('/update_customer/{id}', [App\Http\Controllers\ContactsController::class, 'update_customer'])->name('update_customer');
Route::post('/delete_contacts/{id}', [App\Http\Controllers\ContactsController::class, 'delete_contacts'])->name('delete_contacts');
Route::post('/add-supplier', [App\Http\Controllers\ContactsController::class, 'add_supplier'])->name('add-supplier');
Route::get('/supplier_data', [App\Http\Controllers\ContactsController::class, 'supplier_data'])->name('supplier_data');
Route::post('/update_supplier/{id}', [App\Http\Controllers\ContactsController::class, 'update_supplier'])->name('update_supplier');
 Route::resource('contacts','ContactsController');
Route::resource('purchases','PurchaseController');

Route::post('/add-purchase', [App\Http\Controllers\PurchaseController::class, 'store'])->name('add-purchase');
Route::get('/manage_purchase', [App\Http\Controllers\PurchaseController::class, 'manage_purchase'])->name('manage_purchase');
Route::get('/purchase_data', [App\Http\Controllers\PurchaseController::class, 'purchase_data'])->name('purchase_data');
Route::post('/delete_transactions/{id}', [App\Http\Controllers\PurchaseController::class, 'delete_transactions'])->name('delete_transactions');
Route::get('/edit/{id}', [App\Http\Controllers\PurchaseController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [App\Http\Controllers\PurchaseController::class, 'update'])->name('update');
Route::get('/Pdf/{id}/{type}', [App\Http\Controllers\PdfController::class, 'pdf'])->name('Pdf');
});
