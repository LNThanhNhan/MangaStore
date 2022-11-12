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
        if (Schema::hasColumn('discounts', 'code')) {
            Schema::table('discounts', function (Blueprint $table) {
                $table->string('code')->unique()->change();
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
        if (Schema::hasColumn('discounts', 'code')) {
            Schema::table('discounts', function (Blueprint $table) {
                $table->dropUnique('discounts_code_unique');
            });
        }
    }
};
