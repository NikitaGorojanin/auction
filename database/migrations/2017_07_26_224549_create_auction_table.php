<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id');
            $table->string('car_name');
            $table->integer('category_id');
            $table->string('category_name');
            $table->integer('district_id');
            $table->string('district_name');
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('user_phone');
            $table->string('user_role');
            $table->double('price');
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('partner_lot_id');
            $table->integer('accepted_by_buyer');
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
        //
    }
}
