<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactMsg extends Model
{
    // Table name
    protected $table = 'contact_msgs'; 
    // Change primary key field
    public $primaryKey = 'id'; 
}
