<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id','Recipient_name','Recipient_phone','Recipient_address','shipment_time','totalPrice','ship_status','Purchase_status'
    ];
    public function order_detail()
    {
        return $this->hasMany('App\Order_detail');
    }
}
