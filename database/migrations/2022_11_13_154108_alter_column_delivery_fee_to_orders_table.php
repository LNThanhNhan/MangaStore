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
        if (Schema::hasColumn('orders', 'delivery_fee')) {
            Schema::table('orders', function (Blueprint $table) {
                //rename column
                $table->renameColumn('delivery_fee','shipping_fee');
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
        if (Schema::hasColumn('orders', 'shipping_fee')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->renameColumn('shipping_fee','delivery_fee');
            });
        }
    }
};
