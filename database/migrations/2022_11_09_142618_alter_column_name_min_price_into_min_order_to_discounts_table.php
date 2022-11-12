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
        if (Schema::hasColumn('discounts', 'min_price')) {
            Schema::table('discounts', function (Blueprint $table) {
                $table->renameColumn('min_price', 'min_order');
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
        if (Schema::hasColumn('discounts', 'min_order')) {
            Schema::table('discounts', function (Blueprint $table) {
                $table->renameColumn('min_order', 'min_price');
            });
        }
    }
};
