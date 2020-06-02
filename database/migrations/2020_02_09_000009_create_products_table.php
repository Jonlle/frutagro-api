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
            $table->string('sku', 10)->unique();
            $table->string('product_name', 40)->unique();
            $table->string('slug');
            $table->unsignedInteger('stock')->nullable();
            $table->string('unit_name', 10);
            $table->unsignedInteger('unit_cant');
            $table->unsignedDecimal('price', 11, 2);
            $table->unsignedInteger('discount')->nullable();
            $table->text('description');
            $table->string('file_image')->default('frutagro_product.jpg');
            $table->string('file_path')->default('/images/products');
            $table->string('tags')->nullable();
            $table->string('currency_code_id', 3);
            $table->string('status_id', 2)->default('av');
            $table->timestamps();

            $table->index('category_id');
            $table->index('currency_code_id');
            $table->index('status_id');

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');

            $table->foreign('currency_code_id')
                  ->references('id')->on('currency_codes')
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
