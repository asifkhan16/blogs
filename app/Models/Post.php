<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $title = 'title';
    protected $body = 'body';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
