<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    protected $table = 'transaction_payment';
    protected $fillable = ['transaction_id', 'amount','payment_type','payment_for','payment_date'];
}
