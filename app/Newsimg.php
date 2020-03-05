<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsimg extends Model
{
    //
    protected $table ='news_img';
    protected $fillable = [
        'id','news_id', 'img-url', 'sort'
    ];
}

