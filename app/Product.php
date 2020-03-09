<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'img','kinds','sort','title','content'
    ];
    public function type()
    {
        return $this->belongsTo('App\ProductTypes','kinds', 'id')->orderBy('sort','desc');
    }
}
