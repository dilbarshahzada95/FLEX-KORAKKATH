<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
     protected $table = 'quotation';
    protected $fillable = ['transaction_id','product_name','quantity','purchase_price','final_purchase_price'];
}
