<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\ContactsModel;
use App\Employee;
use App\Salary;
use App\Transaction;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $customer=DB::table('contacts')->select(DB::raw("COUNT(id) as total_customer"))->where('type','customer')->get();  
         $supplier=DB::table('contacts')->select(DB::raw("COUNT(id) as total_supplier"))->where('type','supplier')->get(); 
         $total_purchase=DB::table('transaction')->select(DB::raw("SUM(final_total) as total_purchase"))->where('type','purchase')->get(); 
         $total_sale=DB::table('transaction')->select(DB::raw("SUM(final_total) as total_sale"))->where('type','sell')->get(); 
         $total_expense=DB::table('expense')->select(DB::raw("SUM(amount) as total_expense"))->get();
         $total_employee=DB::table('employee')->select(DB::raw("COUNT(id) as total_employee"))->get();
         $total_salary=DB::table('salary')->select(DB::raw("SUM(salary) as total_salary"))->get();
        
        return view('index',compact('customer','supplier','total_purchase','total_sale','total_expense','total_employee','total_salary'));
    }

    public function logout(Request $request){
        Auth::logout();
        Session::flush();
       return redirect('login');
    }
}
