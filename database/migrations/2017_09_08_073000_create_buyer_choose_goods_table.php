<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerChooseGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_choose_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_order_id');
            $table->integer('buyer_order_id');
            $table->integer('category_id');
            $table->integer('car_id');
            $table->integer('district_id');
            $table->integer('deleted');
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
        Schema::dropIfExists('buyer_choose_goods');
    }
}
