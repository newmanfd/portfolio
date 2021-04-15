<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Table name
    protected $table = 'comments'; 
    // Change primary key field
    public $primaryKey = 'id'; 

    public function post() 
    {
        return $this->belongsTo('App\Post'); 
    }
}
