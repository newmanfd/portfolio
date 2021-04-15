<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table name
    protected $table = 'posts'; 
    // Change primary key field
    public $primaryKey = 'id'; 

    public function user() 
    {
        return $this->belongsTo('App\User'); 
    }

    public function comments() 
    {
        return $this->hasMany('App\Comment'); 
    }
}

