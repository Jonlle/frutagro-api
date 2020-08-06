<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'order_product';

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
            $table->foreignId('order_id')->constrained()
                  ->onDelete('cascade');
            $table->foreignId('product_id')->constrained()
                  ->onDelete('cascade');
            $table->foreignId('tax_id')->constrained()
                  ->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('discount');
            $table->string('unit', 10);

            $table->index('order_id');
            $table->index('product_id');
            $table->index('tax_id');
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
