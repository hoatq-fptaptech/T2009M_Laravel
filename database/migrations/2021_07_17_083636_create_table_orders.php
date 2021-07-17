<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("customer_name");
            $table->string("customer_tel");
            $table->string("customer_address");
            $table->char("city");
            $table->decimal("shipping_fee",14,2);
            $table->decimal("grand_total",14,2);
            $table->timestamps();
        });
        Schema::create('orders_items', function (Blueprint $table) {
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("product_id");
            $table->unsignedInteger("qty")->default(1);
            $table->decimal("price",14,2);// gia ban khac gia san pham
            $table->foreign("order_id")->references("id")->on("orders");
            $table->foreign("product_id")->references("id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_items');
        Schema::dropIfExists('orders');
    }
}
