<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        //check if table order exists
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('name',100);
                $table->string('email',100);
                $table->string('phone',10);
                $table->text('address');
                $table->unsignedInteger('province');
                $table->unsignedInteger('status')->default(0);
                $table->unsignedInteger('payment_method');
                $table->unsignedBigInteger('total_discount')->default(0);
                $table->unsignedBigInteger('delivery_fee')->default(0);
                $table->unsignedBigInteger('total_price');
                $table->dateTime('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('delivery_date')->nullable();
            });
        }
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
