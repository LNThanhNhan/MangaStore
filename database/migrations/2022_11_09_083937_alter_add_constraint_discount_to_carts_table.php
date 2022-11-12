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
        //kiểm tra xem trong bảng carts đã có cột discount chưa
        if(!Schema::hasColumn('carts', 'discount_id')) {
            //nếu chưa có thì thêm cột discount vào bảng carts
            //cột discount tham chiếu đến bảng discounts và khóa chính là id
            //khi xóa bảng discounts thì cột discount sẽ được set null
            Schema::table('carts', function (Blueprint $table) {
                $table->foreignId('discount_id')->nullable()->constrained()->nullOnDelete();
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
        //kiểm tra xem trong bảng carts đã có cột discount không
        if(Schema::hasColumn('carts', 'discount_id')) {
            //nếu có thì xóa cột discount
            Schema::table('carts', function (Blueprint $table) {
                $table->dropForeign(['discount_id']);
                $table->dropColumn('discount_id');
            });
        }
    }
};
