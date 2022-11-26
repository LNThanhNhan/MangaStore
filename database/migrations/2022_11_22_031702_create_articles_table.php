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
        //kiểm tra bảng articles đã tồn tại hay chưa nếu chưa thì tạo mới
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->unique();
                $table->string('slug')->unique();
                $table->string('image');
                $table->text('description');
                $table->text('content');
                $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('articles');
    }
};
