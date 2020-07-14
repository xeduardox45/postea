<?php

namespace App;

use Illuminate\MongoDB\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'image', 'content'
    ];
}
