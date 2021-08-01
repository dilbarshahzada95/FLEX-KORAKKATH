<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    protected $fillable = ['transaction_date', 'category_id','expense_for','amount'];
}
