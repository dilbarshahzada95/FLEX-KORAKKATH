<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactsModel;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCustomerRequest;
use Yajra\DataTables\Facades\DataTables;


class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('add-customer');
    }
    function customer_data(){

         $result = array('data' => array());
         $data=ContactsModel::latest()->where('type','customer')->get();
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button='<td>
                      <button type="button" class="btn bg-gradient-info btn-sm" data-toggle="modal" data-target="#edit" data-keyboard="false" data-backdrop="static" onclick="edit_customer('.$value['id'].');">Edit</button>
                      <a type="button" class="btn bg-gradient-danger btn-sm" data-id="'.$value['id'].'" id="delete">Delete</a>
                    
                    </td>';
                $result['data'][$key] = array(
                $i,
                $value['name'],
                $value['mobile'],
                $value['gst_no'],
                $value['account_no'],
                $value['address'],
                $button,
            );
       $i++;  }
     echo json_encode($result);
    
    }
    public function store(StoreCustomerRequest $request)
    {

        $validated = $request->validated();
        $data = request()->all();
        $data['type'] = 'customer';
        $insert=ContactsModel::create($data);
        if($insert){
            $response=['success' => 'true','messages' =>'Successfully Submitted'];
        }else{
            $response=['success' => 'false','messages' =>'Something went wrong'];
        }
        
        return json_encode($response);
        
        
    }
    public function edit($id)
    {
        $edit=ContactsModel::findOrfail($id);
        return json_encode($edit);
    }
    public function update_customer(Request $request,$id)
    {
        $update=ContactsModel::findOrFail($id);
        $update->name=$request->edit_name;
        $update->mobile=$request->edit_mobile;
        $update->gst_no=$request->edt_gst_no;
        $update->bank=$request->edit_bank;
        $update->branch=$request->edit_branch;
        $update->address=$request->edit_address;
        $update->type='customer';
        $update->save();
        if($update){
            $response=['success' => 'true','messages' =>'Successfully Updated'];
        }else{
            $response=['success' => 'false','messages' =>'Something went wrong'];
        }
        
        return json_encode($response);
    }
     public function delete_contacts($id)
     {
         $delete = ContactsModel::find($id); 
         $delete->delete();

    }
    public function supplier()
    {
        return view('add-supplier');
    }
    public function add_supplier()
    {
        $data = request()->all();
        $data['type'] = 'supplier';
        $insert=ContactsModel::create($data);
        if($insert){
            $response=['success' => 'true','messages' =>'Successfully Submitted'];
        }else{
            $response=['success' => 'false','messages' =>'Something went wrong'];
        }
        
        return json_encode($response);
    }
    function supplier_data(){

         $result = array('data' => array());
         $data=ContactsModel::latest()->where('type','supplier')->get();
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button='<td>
                      <button type="button" class="btn bg-gradient-info btn-sm" data-toggle="modal" data-target="#edit" data-keyboard="false" data-backdrop="static" onclick="edit_supplier('.$value['id'].');">Edit</button>
                      <a type="button" class="btn bg-gradient-danger btn-sm" data-id="'.$value['id'].'" id="delete">Delete</a>
                    
                    </td>';
                $result['data'][$key] = array(
                $i,
                $value['name'],
                $value['mobile'],
                $value['gst_no'],
                $value['account_no'],
                $value['address'],
                $button,
            );
       $i++;  }
     echo json_encode($result);
    
    }
    public function update_supplier(Request $request,$id)
    {
        $update=ContactsModel::findOrFail($id);
        $update->name=$request->edit_name;
        $update->mobile=$request->edit_mobile;
        $update->gst_no=$request->edt_gst_no;
        $update->bank=$request->edit_bank;
        $update->branch=$request->edit_branch;
        $update->address=$request->edit_address;
        $update->type='supplier';
        $update->save();
        if($update){
            $response=['success' => 'true','messages' =>'Successfully Updated'];
        }else{
            $response=['success' => 'false','messages' =>'Something went wrong'];
        }
        
        return json_encode($response);
    }
}
