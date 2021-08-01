<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionPayment;
use App\ContactsModel;
use App\Transaction;
use DB;
class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ledger');
    }
    function ledger_report($id = NULL,$datefrom = NULL,$dateto = NULL){
         $date_from=base64_decode(urldecode($datefrom));
         $date_to=base64_decode(urldecode($dateto));
         $data=TransactionPayment::select('transaction_payment.*','contacts.name as contacts_name')
                           ->leftjoin('contacts','contacts.id','=','transaction_payment.payment_for')
                           ->where('contacts.id', '=', $id)
                           ->whereDate('transaction_payment.payment_date', '>=', $date_from)
                           ->whereDate('transaction_payment.payment_date', '<=', $date_to)
                           ->orderBy('transaction_payment.payment_date', 'asc')
                           ->get();
         return view('ledger-report',compact('data','date_from','date_to'));
    }
    function get_ledger_data(Request $request){
        $type_id=$request->type_id;
        $d_from=$request->datefrom;
        $d_to=$request->dateto;
        $result = array('data' => array());
        $payment=TransactionPayment::select(DB::raw("SUM(IF(transaction_payment.payment_type = 'credit', amount, 0)) as total_recieved"),DB::raw("SUM(IF(transaction_payment.payment_type = 'debit', amount, 0)) as final_amount"),'contacts.name as contacts_name','contacts.type','contacts.id')
                           ->leftjoin('contacts','contacts.id','=','transaction_payment.payment_for')
                           ->groupBy('transaction_payment.payment_for');
                            
        if(!empty($type_id)){
         $payment->where('contacts.id', '=', $type_id);
        }
        if(!empty($d_from)){
            $datefrom=date('Y-m-d',strtotime($d_from));
            $payment->whereDate('transaction_payment.payment_date', '>=', $datefrom); 
        }
        if(!empty($d_to)){
            $dateto=date('Y-m-d',strtotime($d_to));
            $payment->whereDate('transaction_payment.payment_date', '<=', $dateto); 
        }
        $data=$payment->get();
        
        $i=1;
        foreach ($data as $key => $value) {
           $date_from= urlencode( base64_encode($d_from));
            $date_to= urlencode( base64_encode($d_to));
            $button='';
            $button='<td>
                    <a href="'.url('ledger_report/'.$value['id'].'/'.$date_from.'/'.$date_to).'" target="_blank">
                    <button type="button" class="btn btn-block bg-success btn-sm">Ledger</button>
                    </a>
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
        //
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
