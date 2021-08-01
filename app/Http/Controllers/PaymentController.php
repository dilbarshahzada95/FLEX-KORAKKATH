<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionPayment;
use App\ContactsModel;
use App\Transaction;
use DB;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function name_data($type)
    {
        $data=ContactsModel::where('type',$type)->get();
        return json_encode($data);
    }
    function fetchBalancePayment(Request $request){
        // DB::enableQueryLog();
        $type_id=$request->type_id;
        $result = array('data' => array());
        $payment=TransactionPayment::select(DB::raw("SUM(IF(transaction_payment.payment_type = 'credit', amount, 0)) as total_recieved"),DB::raw("SUM(IF(transaction_payment.payment_type = 'debit', amount, 0)) as final_amount"),'contacts.name as contacts_name','contacts.type','contacts.id')
                           ->leftjoin('contacts','contacts.id','=','transaction_payment.payment_for')
                           ->groupBy('transaction_payment.payment_for');
                            
        if(!empty($type_id)){
         $payment->where('contacts.id', '=', $type_id);
        }
       
        $data=$payment->get();
        
        $i=1;
        foreach ($data as $key => $value) {
         
         
            
            $button='';
            $button='<td>
                     <button type="button" class="btn btn-block bg-success btn-sm" data-toggle="modal" data-target="#payment_modal" data-keyboard="false" data-id="'.$value->id.'" data-backdrop="static" id="pay">Pay</button>
                     </td>';
                $result['data'][$key] = array(
                $i,
                $value['contacts_name'],
                $value['type'],
                $value['final_amount'],
                $value['total_recieved'],
                $value['final_amount']-$value['total_recieved'],
                $button,
            );
         $i++;}      
            echo json_encode($result);                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    function pay_amount($id,Request $request){
       $payment=array('amount' => $request->Amount,
            'payment_date' =>  $request->transaction_date,
            'payment_for' => $id,
            'payment_type' => 'credit');
        $TransactionPayment=TransactionPayment::create($payment);
        if($TransactionPayment){
            $response=['success' => 'true'];
        }else{
            $response=['success' => 'false'];
        }
        return json_encode($response);
    }
    function total_balance($id){
         $payment=TransactionPayment::select(DB::raw("SUM(IF(transaction_payment.payment_type = 'credit', amount, 0)) as total_recieved"),DB::raw("SUM(IF(transaction_payment.payment_type = 'debit', amount, 0)) as final_amount"),'contacts.name as contacts_name','contacts.type','contacts.id')
                           ->leftjoin('contacts','contacts.id','=','transaction_payment.payment_for')
                           ->groupBy('transaction_payment.payment_for')
                           ->where('contacts.id', '=', $id)
                           ->get();
                           $response=$payment[0]['final_amount'] -$payment[0]['total_recieved'];
           return json_encode($response);             
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
