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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image');
            $table->string('author');
            $table->string('author_slug');
            $table->bigInteger('price');
            $table->integer('quantity');
            $table->year('publish_year');
            $table->string('size');
            $table->string('category');
            $table->string('category_slug');
            $table->string('collection')->nullable();
            $table->string('collection_slug')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
