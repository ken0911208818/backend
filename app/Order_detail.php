<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table = 'orders_detail';
    protected $fillable = [
        'order_id','product_id','qty','price'
    ];
}
