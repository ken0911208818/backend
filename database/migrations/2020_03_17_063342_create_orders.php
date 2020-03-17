<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('Recipient_name');
            $table->string('Recipient_phone');
            $table->string('Recipient_address');
            $table->string('shipment_time')->default('不指定');
            $table->string('totalPrice');
            $table->string('ship_status')->default('未結帳');
            $table->string('Purchase_status')->default('未送達');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
