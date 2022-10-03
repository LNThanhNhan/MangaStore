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
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->unique()->change();
            $table->unsignedBigInteger('price')->change();
            $table->unsignedInteger('quantity')->change();
            $table->string('author',100)->change();
            $table->string('size',30)->change();
            $table->string('category',50)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->change();
            $table->unsignedBigInteger('price')->change();
            $table->unsignedInteger('quantity')->change();
            $table->string('author')->change();
            $table->string('size')->change();
            $table->string('category')->change();
        });
    }
};
