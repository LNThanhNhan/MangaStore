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
        if (!Schema::hasColumn('products', 'discount_rate')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedInteger('discount_rate')->default(10)->after('list_price');
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
        if (Schema::hasColumn('products', 'discount_rate')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('discount_rate');
            });
        }
    }
};
