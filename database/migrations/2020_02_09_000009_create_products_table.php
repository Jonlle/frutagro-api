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
            $table->foreignId('category_id')->constrained()
                  ->onDelete('cascade');
            $table->string('product_name', 40)->unique();
            $table->string('slug');
            $table->unsignedInteger('discount')->nullable();
            $table->text('description');
            $table->string('file_image')->default('frutagro_product.png');
            $table->string('file_path')->default('/images/products');
            $table->string('currency_code_id', 3)->default('USD');
            $table->string('tags')->nullable();
            $table->string('status_id', 2)->default('av');
            $table->timestamps();

            $table->index('category_id');
            $table->index('currency_code_id');
            $table->index('status_id');

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
