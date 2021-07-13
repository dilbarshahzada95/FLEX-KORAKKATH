<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use PDF;
use DB;
use App\purchaseLine_model;
use App\ContactsModel;
class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id,$type)
    {
        $data=DB::table('transaction')
                  ->select('transaction.*','transaction_purchase.product_name','transaction_purchase.quantity','transaction_purchase.purchase_price','contacts.*')  
                  ->leftjoin('transaction_purchase','transaction_purchase.transaction_id','=','transaction.id')  
                  ->leftjoin('contacts','contacts.id','=','transaction.contact_id') 
                  ->get();  
                // var_dump($data->name);
                  $pdf = PDF::loadView('reciept', compact('data','type'));
                    return $pdf->download('invoice.pdf');
        // return view('reciept',compact('data','type'));
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
