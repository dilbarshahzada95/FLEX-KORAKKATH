<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchaseLine_model extends Model
{
    
    protected $table = 'transaction_purchase';
    protected $fillable = ['transaction_id','product_name','quantity','purchase_price','final_purchase_price'];
    
}
