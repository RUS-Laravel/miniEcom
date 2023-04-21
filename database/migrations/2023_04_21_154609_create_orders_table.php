<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('no')->unique();
            $table->string('status');
            $table->string('payment_type');
            $table->string('payment_status');
            $table->decimal('discount')->default(0);
            $table->decimal('tax')->default(0);
            $table->decimal('shipment')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('adress_id')->nullable();
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
};
