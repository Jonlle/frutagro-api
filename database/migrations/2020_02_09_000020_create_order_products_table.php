<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'order_products';

    /**
     * Run the migrations.
     * @table order_products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('discount');
            $table->string('unit', 10);

            $table->index(["order_id"], 'fk_order_products_orders_idx');
            $table->index(["product_id"], 'fk_order_products_products_idx');
            $table->index(["tax_id"], 'fk_order_products_taxes_idx');

            $table->foreignId('order_id')->constrained()
                  ->onDelete('cascade');

            $table->foreignId('product_id')->constrained()
                  ->onDelete('cascade');

            $table->foreignId('tax_id')->constrained()
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
