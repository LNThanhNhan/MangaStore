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
        if (Schema::hasColumn('products', 'price')) {
            Schema::table('products', function (Blueprint $table) {
                $results = DB::table('products')->select('id','list_price','discount_rate')->get();
                $i = 1;
                foreach ($results as $result){
                    DB::table('products')
                        ->where('id',$result->id)
                        ->update([
                            "price" => $result->list_price - ($result->list_price * ($result->discount_rate/100))
                        ]);
                    $i++;
                }
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
        if (Schema::hasColumn('products', 'price')) {
            Schema::table('products', function (Blueprint $table) {
                $results = DB::table('products')->select('id','list_price','discount_rate')->get();
                $i = 1;
                foreach ($results as $result){
                    DB::table('products')
                        ->where('id',$result->id)
                        ->update([
                            "price" => 0
                        ]);
                    $i++;
                }
            });
        }
    }
};
