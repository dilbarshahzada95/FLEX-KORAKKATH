<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\EmployeeController;
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
Route::post('/logout', 'HomeController@logout')->name('logout');

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
Route::resource('sales','SalesController');
Route::resource('payment','PaymentController');
Route::resource('ledger','LedgerController');
Route::resource('expense-category','ExpenseCategoryController');
Route::resource('expense','ExpenseController');
Route::resource('quotation','QuotationController');
Route::resource('employee','EmployeeController');

Route::post('/add-purchase', [App\Http\Controllers\PurchaseController::class, 'store'])->name('add-purchase');
Route::get('/manage_purchase', [App\Http\Controllers\PurchaseController::class, 'manage_purchase'])->name('manage_purchase');
Route::get('/purchase_data', [App\Http\Controllers\PurchaseController::class, 'purchase_data'])->name('purchase_data');
Route::post('/delete_transactions/{id}', [App\Http\Controllers\PurchaseController::class, 'delete_transactions'])->name('delete_transactions');
Route::get('/edit/{id}', [App\Http\Controllers\PurchaseController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [App\Http\Controllers\PurchaseController::class, 'update'])->name('update');
Route::get('/Pdf/{id}', [App\Http\Controllers\PdfController::class, 'pdf'])->name('Pdf');
Route::get('/quatation_Pdf/{id}', [App\Http\Controllers\PdfController::class, 'quatation_Pdf'])->name('quatation_Pdf');
Route::get('/add-sales', [App\Http\Controllers\SalesController::class, 'add_sales'])->name('add-sales');
Route::get('/sales_data', [App\Http\Controllers\SalesController::class, 'sales_data'])->name('sales_data');
Route::get('/sales-edit/{id}', [App\Http\Controllers\SalesController::class, 'edit'])->name('sales-edit/');
Route::post('/sales_update/{id}', [App\Http\Controllers\SalesController::class, 'update'])->name('sales_update');
Route::get('/sale-Pdf/{id}', [App\Http\Controllers\PdfController::class, 'sale_pdf'])->name('sale-Pdf');
Route::get('/name_data/{type}', [App\Http\Controllers\PaymentController::class, 'name_data'])->name('name_data');
Route::get('/fetchBalancePayment', [App\Http\Controllers\PaymentController::class, 'fetchBalancePayment'])->name('fetchBalancePayment');
Route::post('/pay_amount/{id}', [App\Http\Controllers\PaymentController::class, 'pay_amount'])->name('pay_amount');
Route::get('/total_balance/{id}', [App\Http\Controllers\PaymentController::class, 'total_balance'])->name('total_balance');
Route::get('/get_ledger_data', [App\Http\Controllers\LedgerController::class, 'get_ledger_data'])->name('get_ledger_data');
Route::get('/ledger_report/{id}/{datefrom}/{dateto}', [App\Http\Controllers\LedgerController::class, 'ledger_report'])->name('ledger_report');
Route::get('/get_expense_category', [App\Http\Controllers\ExpenseCategoryController::class, 'get_expense_category'])->name('get_expense_category');
Route::post('/destroy/{id}', [App\Http\Controllers\ExpenseCategoryController::class, 'destroy'])->name('destroy');
Route::post('/edit_expense_category/{id}', [App\Http\Controllers\ExpenseCategoryController::class, 'edit_expense_category'])->name('edit_expense_category');
Route::post('/update_expense_category/{id}', [App\Http\Controllers\ExpenseCategoryController::class, 'update'])->name('update_expense_category');
Route::get('/manage_expense', [App\Http\Controllers\ExpenseController::class, 'manage_expense'])->name('manage_expense');
Route::get('/expesne_data', [App\Http\Controllers\ExpenseController::class, 'expesne_data'])->name('expesne_data');
Route::post('/delete_expense/{id}', [App\Http\Controllers\ExpenseController::class, 'delete_expense'])->name('delete_expense');
Route::get('/expense_edit/{id}', [App\Http\Controllers\ExpenseController::class, 'expense_edit'])->name('expense_edit');
Route::post('/expense_update/{id}', [App\Http\Controllers\ExpenseController::class, 'update'])->name('expense_update');
Route::get('/quotaton_data', [App\Http\Controllers\QuotationController::class, 'quotaton_data'])->name('quotaton_data');
Route::get('/manage_quottaion', [App\Http\Controllers\QuotationController::class, 'manage_quottaion'])->name('manage_quottaion');
Route::get('/edit_quotation/{id}', [App\Http\Controllers\QuotationController::class, 'edit_quotation'])->name('edit_quotation');
Route::post('/update_quotation/{id}', [App\Http\Controllers\QuotationController::class, 'update_quotation'])->name('update_quotation');
Route::post('/insert-employee', [App\Http\Controllers\EmployeeController::class, 'insert_employee'])->name('insert-employee');
Route::get('/fetchEmployeeData', [App\Http\Controllers\EmployeeController::class, 'fetchEmployeeData'])->name('fetchEmployeeData');
Route::post('/delete_employee/{id}', [App\Http\Controllers\EmployeeController::class, 'delete_employee'])->name('delete_employee');
Route::post('/edit_employee_data/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('edit_employee_data');
Route::post('/update-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'update_employee'])->name('update-employee');
Route::get('/salary', [App\Http\Controllers\EmployeeController::class, 'salary'])->name('salary');
Route::post('/insert-salary', [App\Http\Controllers\EmployeeController::class, 'insert_salary'])->name('insert-salary');
Route::get('/fetchSalaryData', [App\Http\Controllers\EmployeeController::class, 'fetchSalaryData'])->name('fetchSalaryData');
Route::post('/delete_salary/{id}', [App\Http\Controllers\EmployeeController::class, 'delete_salary'])->name('delete_salary');
});
