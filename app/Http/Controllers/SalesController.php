<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactsModel;
use App\Transaction;
use App\TransactionPayment;
use App\Sales;
use DB;
class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=ContactsModel::latest()->where('type','customer')->get();
        return view('manage-sales',compact('data'));
    }
    public function add_sales()
    {
        $data=ContactsModel::latest()->where('type','customer')->get();
        return view('add-sales',compact('data'));
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
        $data=$request->only(['invoice_no', 'contact_id','transaction_date','final_total','advance']);
        $data['type'] = 'sell';
        // dd($request->product_name );die;
        $sell=Transaction::create($data);
        $product_list=$request->sell;
        foreach($product_list as  $value){
        $sellLines=array('transaction_id'=>$sell->id,
                                'product_name'=>$value['product_name'],
                                'quantity'=>$value['quantity'],
                                'sell_price'=>$value['sell_price'],
                                'final_sell_price'=>$value['quantity']*$value['sell_price'],
                               );
        $sellLines_data=Sales::create($sellLines);
        }
        $payment=array('transaction_id'=>$sell->id,
                        'amount'=> $request->final_total,
                        'payment_type'=>'debit',
                        'payment_for'=>$request->contact_id,
                        'payment_date'=>$request->transaction_date
                         );
        $TransactionPayment=TransactionPayment::create($payment);
        if($request->advance > 0){
            $creditpayment=array('transaction_id'=>$sell->id,
                        'amount'=> $request->advance,
                        'payment_type'=>'credit',
                        'payment_for'=>$request->contact_id,
                        'payment_date'=>$request->transaction_date
                         );
        $TransactionPayment=TransactionPayment::create($creditpayment);
        }
        
        return redirect()->back()->with('message','Successfully Submited');
    }
    function sales_data(Request $request){
         $result = array('data' => array());
         $sales=Transaction::select('transaction.*','contacts.name as contacts_name')
                            ->leftjoin('contacts','contacts.id','=','transaction.contact_id')
                            ->where('transaction.type','=','sell'); 
        if(!empty($request->datefrom)){
         $datefrom=date('Y-m-d',strtotime($request->datefrom));
        
         $sales->whereDate('transaction.transaction_date', '>=', $datefrom);
               
        }
        if (!empty($request->dateto)) {
            $dateto=date('Y-m-d',strtotime($request->dateto));
            $sales->whereDate('transaction.transaction_date', '<=', $dateto); 
        }
        if(!empty($request->contact_id)){
            $sales->where('contacts.id', $request->contact_id);
        }
        $data=$sales->get();
         // var_dump(json_decode($data));
                            // dd(DB::getQueryLog());
         $i=1;
         foreach ($data as $key => $value) {
            $button='';
            $button='<td>
                      <a href="'.url('sales-edit/'.$value['id']).'" type="button" class="btn bg-gradient-info btn-sm" >Edit</a>
                      <a type="button" class="btn bg-gradient-danger btn-sm" data-id="'.$value['id'].'" id="delete">Delete</a>
                      <a type="button" href="'.url('sale-Pdf/'.$value['id']).'" target="_blank" class="btn bg-gradient-blue btn-sm">Pdf</a>
                      </td>';
                $result['data'][$key] = array(
                $i,
                $value['transaction_date'],
                $value['invoice_no'],
                $value['contacts_name'],
                $value['final_total'],
                $value['advance'],
                $button,
            );
       $i++;  }
     echo json_encode($result);
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
        $data=ContactsModel::latest()->where('type','customer')->get();
        $sales_data=Transaction::findOrfail($id);
        $sellLines_data=DB::table('transaction_sales')
                            ->select('transaction_sales.*')
                            ->where('transaction_sales.transaction_id','=',$id)
                            ->get();
        return view('edit-sales',compact('data','sales_data','sellLines_data'));
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
        $update->invoice_no=$request->invoice_no;
        $update->contact_id=$request->contact_id;
        $update->transaction_date=$request->transaction_date;
        $update->advance=$request->advance;
        $update->final_total=$request->final_total;
        $update->type='sell';
        $update->save();
        $delete = Sales::where('transaction_id','=',$id); 
        $delete->delete();
        $sell_list=$request->sell;
        foreach($sell_list as  $value){
        $sellLines=array('transaction_id'=>$id,
                                'product_name'=>$value['product_name'],
                                'quantity'=>$value['quantity'],
                                'sell_price'=>$value['sell_price'],
                                'final_sell_price'=>$value['quantity']*$value['sell_price'],
                               );
        $sellLineData=Sales::create($sellLines);
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
        return redirect('sales');
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
