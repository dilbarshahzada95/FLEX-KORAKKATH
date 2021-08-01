<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'transaction_sales';
    protected $fillable = ['transaction_id','product_name','quantity','sell_price','final_sell_price'];
}
