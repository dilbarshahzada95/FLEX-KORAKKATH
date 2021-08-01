<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use DB;
use Yajra\DataTables\Facades\DataTables;
class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense-category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert=ExpenseCategory::create($request->all());
        if($insert){
            $response=['success' => 'true'];
        }else{
            $response=['success' => 'false'];
        }
        
        return json_encode($response);
    }
    function get_expense_category(){
       $data=ExpenseCategory::latest()->get();
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button='<td>
                    <a type="button" class="btn bg-gradient-info btn-sm" data-toggle="modal" data-target="#Edit_expense_category_modal" data-keyboard="false" data-backdrop="static" onclick="edit_expense_category('.$value['id'].');">Edit</a>
                    <a type="button" id="delete"  data-id="'.$value['id'].'"  class="btn bg-gradient-danger btn-sm">Delete</a>
                    </td>';
                $result['data'][$key] = array(
                $i,
                $value['name'],
                 $button,
            );
       $i++;  }
     echo json_encode($result);
    }
    function edit_expense_category($id){
        $edit=ExpenseCategory::findOrfail($id);
        return json_encode($edit);
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
    public function edit($id)
    {
        //
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
        $update=ExpenseCategory::findOrFail($id);
        $update->name=$request->edit_name;
        
        $update->save();
        if($update){
            $response=['success' => 'true'];
        }else{
            $response=['success' => 'false'];
        }
        
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $delete = ExpenseCategory::find($id); 
         $delete->delete();
    }
}
