<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'products';

    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('category_id', 25);
            $table->foreignId('currency_code_id')->constrained()
                  ->onDelete('cascade');
            $table->string('status_id', 2);
            $table->string('product_name', 40);
            $table->string('description', 50);
            $table->double('price', 11, 2);
            $table->unsignedInteger('discount');
            $table->string('unit', 10);
            $table->unsignedInteger('stock_cant');
            $table->string('sku', 10);

            $table->index('category_id');
            $table->index('currency_code_id');
            $table->index('status_id');

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');

            $table->foreign('status_id')
                  ->references('id')->on('statuses')
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
