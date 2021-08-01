<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];
    protected $table = 'transaction';
    protected $fillable = ['type', 'contact_id','invoice_no','ref_no','payment_status','final_total','advance','transaction_date'];
    
    
}
