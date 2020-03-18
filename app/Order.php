<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'order_no','user_id','Recipient_name','Recipient_phone','Recipient_address','shipment_time','totalPrice','ship_status','Purchase_status','ship_price'
    ];
    public function order_detail()
    {
        return $this->hasMany('App\Order_detail');
    }
}
