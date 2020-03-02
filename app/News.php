<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{       //一個資料表時不用[]
    protected $table ='news';
    protected $fillable = [
        'img', 'title', 'content',
    ];
}
