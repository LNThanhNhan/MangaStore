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
        //nếu bảng employees chưa tồn tại thì tạo mới
        if (!Schema::hasTable('employees')) {
            Schema::create('employees', function (Blueprint $table) {
                $table->id();
                $table->foreignId('account_id')->constrained('accounts')->CascadeOnDelete();
                $table->string('name');
                $table->date('birthday');
                $table->boolean('gender');
                $table->string('phone',10);
                $table->text('address');
                $table->unsignedInteger('province');
                $table->unsignedBigInteger('salary');
                $table->unsignedInteger('status')->default(0);
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
        Schema::dropIfExists('employees');
    }
};
