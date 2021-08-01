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
    public function pdf($id)
    {
        $data=DB::table('transaction')
                  ->select('transaction.*','transaction_purchase.product_name','transaction_purchase.quantity','transaction_purchase.purchase_price','contacts.*','transaction.type as purchase_type')  
                  ->leftjoin('transaction_purchase','transaction_purchase.transaction_id','=','transaction.id')  
                  ->leftjoin('contacts','contacts.id','=','transaction.contact_id') 
                  ->where('transaction.type','purchase')
                  ->where('transaction.id',$id)
                  ->get();  
             
        return view('reciept',compact('data'));
    }
    public function sale_Pdf($id)
    {
        $sale_pdf=DB::table('transaction')
                  ->select('transaction.*','transaction_sales.product_name','transaction_sales.quantity','transaction_sales.sell_price','contacts.*','transaction.type as sell_type')  
                  ->leftjoin('transaction_sales','transaction_sales.transaction_id','=','transaction.id')  
                  ->leftjoin('contacts','contacts.id','=','transaction.contact_id') 
                  ->where('transaction.type','sell')
                  ->where('transaction.id',$id)
                  ->get();  
             
        return view('sale-reciept',compact('sale_pdf'));
    }
    public function quatation_Pdf($id)
    {
        $data=DB::table('transaction')
                  ->select('transaction.*','quotation.product_name','quotation.quantity','quotation.purchase_price','contacts.*','transaction.type as purchase_type')  
                  ->leftjoin('quotation','quotation.transaction_id','=','transaction.id')  
                  ->leftjoin('contacts','contacts.id','=','transaction.contact_id') 
                  ->where('transaction.type','quotation')
                  ->where('transaction.id',$id)
                  ->get();   
                  // var_dump($data);die;
        $final_round=round($data[0]->final_total);
        return view('quataion_reciept',compact('data','final_round'));
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
