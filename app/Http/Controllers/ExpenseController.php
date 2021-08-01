<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use App\Expense;
use DB;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=ExpenseCategory::latest()->get();
        return view('add-expense',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_expense()
    {
        $data=ExpenseCategory::latest()->get();
        return view('expense',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert=Expense::create($request->all());
        return redirect('manage_expense');
    }

    function expesne_data(Request $request){
        $d_from=$request->datefrom;
        $d_to=$request->dateto;
         $result = array('data' => array());
         $expense=Expense::select('expense.*','expense_category.name as category_name')
                            ->leftjoin('expense_category','expense_category.id','=','expense.category_id');
                            
        if(!empty($d_from)){
         $datefrom=date('Y-m-d',strtotime($d_from));
         $expense->whereDate('expense.transaction_date', '>=', $datefrom);
               
        }
        if(!empty($d_to)){
             $dateto=date('Y-m-d',strtotime($d_to));
            $expense->whereDate('expense.transaction_date', '<=', $dateto); 
        }
        if(!empty($request->category_id)){
            $expense->where('expense_category.id', $request->category_id);
        }
        $data=$expense->get();
        
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button=' <td>
                    <a href="'.url('expense_edit/'.$value['id']).'" type="button"  class="btn bg-gradient-info btn-sm" >Edit</a>
                    <a type="button" class="btn bg-gradient-danger btn-sm" id="delete" data-id="'.$value['id'].'">Delete</a>
                </td>';
          
                $result['data'][$key] = array(
                $i,
                $value['transaction_date'],
                $value['category_name'],
                $value['expense_for'],
                $value['amount'],
               
                $button,
            );
       $i++;  }
     echo json_encode($result);
    }

    function delete_expense($id){
        $delete = Expense::find($id); 
        $delete->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function expense_edit($id)
    {
        $data=ExpenseCategory::latest()->get();
        $expense_data=Expense::findOrfail($id);
        return view('edit-expense',compact('data','expense_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update=Expense::findOrFail($id);
        $update->transaction_date=$request->transaction_date;
        $update->category_id=$request->category_id;
        $update->expense_for=$request->expense_for;
        $update->amount=$request->amount;
        $update->save();
        return redirect('manage_expense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
