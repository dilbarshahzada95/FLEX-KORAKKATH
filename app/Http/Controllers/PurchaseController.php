<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactsModel;
use App\Transaction;
use App\purchaseLine_model;
use App\TransactionPayment;
use DB;
use session;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=ContactsModel::latest()->where('type','supplier')->get();
        return view('add-purchase',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_purchase()
    {
        $data=ContactsModel::latest()->where('type','supplier')->get();
        return view('manage-purchase',compact('data'));
    }
    function purchase_data(Request $request){
        $d_from=$request->datefrom;
        $d_to=$request->dateto;
         $result = array('data' => array());
         $purchase=Transaction::select('transaction.*','contacts.name as contacts_name')
                            ->leftjoin('contacts','contacts.id','=','transaction.contact_id')
                            ->where('transaction.type','=','purchase');  
        if(!empty($d_from)){
         $datefrom=date('Y-m-d',strtotime($d_from));
         $purchase->whereDate('transaction.transaction_date', '>=', $datefrom);
               
        }
        if(!empty($d_to)){
             $dateto=date('Y-m-d',strtotime($d_to));
            $purchase->whereDate('transaction.transaction_date', '<=', $dateto); 
        }
        if(!empty($request->contact_id)){
            $purchase->where('contacts.id', $request->contact_id);
        }
        $data=$purchase->get();
         // var_dump(json_decode($data));
                            // dd(DB::getQueryLog());
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button='<td>
                      <a href="'.url('edit/'.$value['id']).'" type="button" class="btn bg-gradient-info btn-sm" >Edit</a>
                      <a type="button" class="btn bg-gradient-danger btn-sm" data-id="'.$value['id'].'" id="delete">Delete</a>
                      <a type="button" href="'.url('Pdf/'.$value['id']).'" target="_blank" class="btn bg-gradient-blue btn-sm">Pdf</a>
                      </td>';
                $result['data'][$key] = array(
                $i,
                $value['transaction_date'],
                $value['ref_no'],
                $value['contacts_name'],
                $value['final_total'],
                $value['advance'],
                $button,
            );
       $i++;  }
     echo json_encode($result);
    }

   
    public function store(Request $request)
    {
        
        $data=$request->only(['ref_no', 'contact_id','transaction_date','final_total','advance']);
        $data['type'] = 'purchase';
        // dd($request->product_name );die;
        $purchase=Transaction::create($data);
        $product_list=$request->purchase;
        foreach($product_list as  $value){
        $purchaseLine=array('transaction_id'=>$purchase->id,
                                'product_name'=>$value['product_name'],
                                'quantity'=>$value['quantity'],
                                'purchase_price'=>$value['purchase_price'],
                                'final_purchase_price'=>$value['quantity']*$value['purchase_price'],
                               );
        $purchase_data=purchaseLine_model::create($purchaseLine);
        }
        $payment=array('transaction_id'=>$purchase->id,
                        'amount'=> $request->final_total,
                        'payment_type'=>'debit',
                        'payment_for'=>$request->contact_id,
                        'payment_date'=>$request->transaction_date
                         );
        $TransactionPayment=TransactionPayment::create($payment);
        if($request->advance > 0){
        $creditpayment=array('transaction_id'=>$purchase->id,
                        'amount'=> $request->advance,
                        'payment_type'=>'credit',
                        'payment_for'=>$request->contact_id,
                        'payment_date'=>$request->transaction_date
                         );
        $TransactionPayment=TransactionPayment::create($creditpayment);
        }
        
        
        return redirect('manage_purchase')->with('message','Successfully Submited');
    }
    function  delete_transactions($id){
        $delete = Transaction::find($id); 
        $delete->delete();
    }

   
    public function edit($id)
    {
        $data=ContactsModel::latest()->where('type','supplier')->get();
        $purchase_data=Transaction::findOrfail($id);
        $purchaseLine_data=DB::table('transaction_purchase')
                            ->select('transaction_purchase.*')
                            ->where('transaction_purchase.transaction_id','=',$id)
                            ->get();
        // dd($purchase_data);die;
        return view('edit-purchase',compact('data','purchase_data','purchaseLine_data'));
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
        $update=Transaction::findOrFail($id);
        // dd($update);die;
        $update->ref_no=$request->ref_no;
        $update->contact_id=$request->contact_id;
        $update->transaction_date=$request->transaction_date;
        $update->advance=$request->advance;
        $update->final_total=$request->final_total;
        $update->type='purchase';
        $update->save();
        $delete = purchaseLine_model::where('transaction_id','=',$id); 
        $delete->delete();
        $product_list=$request->purchase;
        foreach($product_list as  $value){
        $purchaseLine=array('transaction_id'=>$id,
                                'product_name'=>$value['product_name'],
                                'quantity'=>$value['quantity'],
                                'purchase_price'=>$value['purchase_price'],
                                'final_purchase_price'=>$value['quantity']*$value['purchase_price'],
                               );
        $purchase_data=purchaseLine_model::create($purchaseLine);
        }
        $delete_payment = TransactionPayment::where('transaction_id','=',$id); 
        $delete_payment->delete();
        $payment=array('transaction_id'=>$id,
                        'amount'=> $request->final_total,
                        'payment_type'=>'debit',
                        'payment_for'=>$request->contact_id,
                        'payment_date'=>$request->transaction_date
                         );
        $TransactionPayment=TransactionPayment::create($payment);
        if($request->advance > 0){
            $creditpayment=array('transaction_id'=>$id,
                        'amount'=> $request->advance,
                        'payment_type'=>'credit',
                        'payment_for'=>$request->contact_id,
                        'payment_date'=>$request->transaction_date
                         );
        $TransactionPayment=TransactionPayment::create($creditpayment);
        }
        
        $request->session()->flash('success','Successfully updated');
        return redirect('manage_purchase');
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
