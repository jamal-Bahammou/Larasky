<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    
    protected $table = 'posts';     // Table name
    public $primaryKey = 'id';      // Primary key
    public $timestamps = true;      // Timestamps

    public function user() {
        return $this->belongsTo('App\User');
    }

}
