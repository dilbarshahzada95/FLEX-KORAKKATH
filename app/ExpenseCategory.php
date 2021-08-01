<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table = 'expense_category';
    protected $fillable = ['name'];
    public function getData()
    {
        return static::orderBy('created_at','desc')->get();
    }
}
