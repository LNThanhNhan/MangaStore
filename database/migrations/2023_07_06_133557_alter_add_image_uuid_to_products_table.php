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
        if (!Schema::hasColumn('products', 'image_uuid')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('image_uuid', 36)->after('description');
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
        if (Schema::hasColumn('products', 'image_uuid')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('image_uuid');
            });
        }
    }
};
