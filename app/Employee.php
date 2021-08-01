<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $fillable = ['name', 'date_of_joining','date_of_resigning','mob','aadar_no','idcard_no','image','address'];
}
