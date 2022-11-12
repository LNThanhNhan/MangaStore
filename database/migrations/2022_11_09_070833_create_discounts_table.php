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
        if(!Schema::hasTable('discounts')) {
            Schema::create('discounts', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code');
                $table->unsignedInteger('type');
                $table->unsignedBigInteger('min_price');
                $table->unsignedBigInteger('value');
                $table->unsignedBigInteger('max_discount');
                $table->unsignedInteger('quantity');
                $table->dateTime('begin_at');
                $table->dateTime('end_at');
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
        Schema::dropIfExists('discounts');
    }
};
