<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //Kurye Müşterinin adından takip etsin diye müşteri ismi ekliyoruz
            $table->string('customer_name')->nullable();
            //Müşteri ile eşleştirme sağlatmak ve bildirim göndermek için gerekiyor
            $table->string('customer_phone',25);
            $table->tinyInteger('track_mode_status')->default(0);
            $table->integer('courier_number')->nullable();
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
