<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactsModel;
use App\Quotation;
use App\Transaction;
use DB;
class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=ContactsModel::latest()->where('type','customer')->get();
        return view('add-quotation',compact('data'));
    }
    function manage_quottaion(){

        return view('quotation');
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
        $data=$request->only([ 'contact_id','transaction_date','final_total']);
        $data['type'] = 'quotation';
        $quotation=Transaction::create($data);
        $product_list=$request->purchase;
        foreach($product_list as  $value){
        $quotationLine=array('transaction_id'=>$quotation->id,
                                'product_name'=>$value['product_name'],
                                'quantity'=>$value['quantity'],
                                'purchase_price'=>$value['purchase_price'],
                                'final_purchase_price'=>$value['quantity']*$value['purchase_price'],
                               );
        $purchase_data=Quotation::create($quotationLine);
        }
        
     return redirect('manage_quottaion');
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
    public function edit_quotation($id)
    {
         $data=ContactsModel::latest()->where('type','customer')->get();
         $purchase_data=Transaction::findOrfail($id);
         $purchaseLine_data=DB::table('quotation')
                            ->select('quotation.*')
                            ->where('quotation.transaction_id','=',$id)
                            ->get();
        // dd($purchase_data);die;
        return view('edit-quotation',compact('data','purchase_data','purchaseLine_data'));
    }

    function quotaton_data(Request $request){
        $d_from=$request->datefrom;
        $d_to=$request->dateto;
         $result = array('data' => array());
         $purchase=Transaction::select('transaction.*','contacts.name as contacts_name')
                            ->leftjoin('contacts','contacts.id','=','transaction.contact_id')
                            ->where('transaction.type','=','quotation');  
    
        $data=$purchase->get();
        
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button=' <td>
                      <a type="button" href="'.url('edit_quotation/'.$value['id']).'" class="btn bg-gradient-info btn-sm" >Edit</a>
                      <a type="button" class="btn bg-gradient-danger btn-sm" data-id="'.$value['id'].'" id="delete">Delete</a>
                      <a type="button" href="'.url('quatation_Pdf/'.$value['id']).'" class="btn bg-gradient-blue btn-sm">Pdf</a>
                      </td>
                    </td>';
                $result['data'][$key] = array(
                $i,
                $value['contacts_name'],
                $value['transaction_date'],
                $value['final_total'],
                $button,
            );
       $i++;  }
     echo json_encode($result);
    }

    function update_quotation(Request $request, $id){
         $update=Transaction::findOrFail($id);
        // dd($update);die;
        
        $update->contact_id=$request->contact_id;
        $update->transaction_date=$request->transaction_date;
        $update->final_total=$request->final_total;
        $update->type='quotation';
        $update->save();
        $delete = Quotation::where('transaction_id','=',$id); 
        $delete->delete();
        $product_list=$request->purchase;
        foreach($product_list as  $value){
        $purchaseLine=array('transaction_id'=>$id,
                                'product_name'=>$value['product_name'],
                                'quantity'=>$value['quantity'],
                                'purchase_price'=>$value['purchase_price'],
                                'final_purchase_price'=>$value['quantity']*$value['purchase_price'],
                               );
        $purchase_data=Quotation::create($purchaseLine);
        }
       
        
        $request->session()->flash('success','Successfully updated');
        return redirect('manage_quottaion');
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
