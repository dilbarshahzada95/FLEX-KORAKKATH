<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Salary;
use DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee');
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
    public function insert_employee(Request $request)
    {
        
        $data = $request->all();
        // dd($data);die;
        if ($request->hasFile('image')){
        $path = Storage::disk('public')->put('employee_image', $request->file('image'));
        }
        if ($request->hasFile('image')){
        $data['image'] = $path;
        }
        $insert=Employee::create($data);
       
        
        return redirect()->back();
    }
    function fetchEmployeeData(){
         $result = array('data' => array());
         $data=Employee::latest()->get();
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button='<td>
                    <a type="button" class="btn bg-gradient-info btn-sm" data-toggle="modal" data-target="#edit_employee_modal" data-keyboard="false" data-backdrop="static"  onclick="edit_employee('.$value['id'].');">Edit</a>
                    <a type="button" class="btn bg-gradient-danger btn-sm" data-id="'.$value['id'].'" id="delete">Delete</a>
                </td>';
                $img='<img src="storage/'.$value['image'].'" style="width: 80px;" alt="">';
                $result['data'][$key] = array(
                $i,
                $value['name'],
                $value['date_of_joining'],
                $value['date_of_resigning'],
                $value['mob'],
                $value['address'],
                $value['aadar_no'],
                $value['idcard_no'],
                $img,
                $button,
            );
       $i++;  }
     echo json_encode($result);
    }

     public function delete_employee($id)
     {
         $delete = Employee::find($id); 
         Storage::disk('public')->delete('app/employee_image',$delete->image);
         $delete->delete();

    }

    function update_employee(Request $request,$id){
        $update=Employee::findOrFail($id);
        $update->name=$request->edit_name;
        $update->date_of_resigning=$request->date_of_resigning;
        $update->mob=$request->edit_mob;
        $update->aadar_no=$request->edit_aadar_no;
        $update->idcard_no=$request->edit_idcard_no;
        $update->address=$request->edit_address;
        if ($request->hasFile('edit_images')){
        $path = Storage::disk('public')->put('employee_image', $request->file('edit_images'));
        }
        if ($request->hasFile('edit_images')){
        $update->image = $path;
        }     
        $update->save();
        if($update){
            $response=['success' => 'true','messages' =>'Successfully Updated'];
        }else{
            $response=['success' => 'false','messages' =>'Something went wrong'];
        }
        
        return json_encode($response);
    }
    function salary(){
        $data=Employee::latest()->get();
        return view('salary',compact('data'));
    }

    function insert_salary(){

        $data = request()->all();
        
        $insert=Salary::create($data);
        if($insert){
            $response=['success' => 'true'];
        }else{
            $response=['success' => 'false'];
        }
        
        return json_encode($response);
    }

    function fetchSalaryData(){
         $result = array('data' => array());
         $data=Salary::select('salary.*','employee.name as emp_name')
         ->leftjoin('employee','employee.id','=','salary.employee_id')
         ->latest()
         ->get();
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button='<td>
                    
                    <a type="button" class="btn bg-gradient-danger btn-sm"  data-id="'.$value['id'].'" id="deletee">Delete</a>
                </td>';
                
                $result['data'][$key] = array(
                $i,
                $value['emp_name'],
                $value['date'],
                $value['salary'],
             
                $button,
            );
       $i++;  }
     echo json_encode($result);
    }
   
     public function delete_salary($id)
     {
         $delete = Salary::find($id); 
        
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
    public function edit($id)
    {
        $edit=Employee::findOrfail($id);
        return json_encode($edit);
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
        //
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
