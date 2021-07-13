<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactsModel extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['type', 'name','mobile','gst_no','bank','branch','account_no','ifsc','address'];
    protected $guarded=[];
}
