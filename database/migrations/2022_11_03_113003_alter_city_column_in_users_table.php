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
        if (!Schema::hasColumn('users', 'province')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('city');
                $table->unsignedInteger('province')->after('address')->nullable();
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
        if (Schema::hasColumn('users', 'province')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('province');
                $table->string('city',100)->after('address')->nullable();
            });
        }
    }
};
