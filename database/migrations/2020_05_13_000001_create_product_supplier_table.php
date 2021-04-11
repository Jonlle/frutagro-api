<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSupplierTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'product_supplier';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->foreignId('supplier_id')->constrained()
                  ->onDelete('cascade');
            $table->foreignId('product_id')->constrained()
                  ->onDelete('cascade');

            $table->primary(['supplier_id', 'product_id']);

            $table->index('supplier_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_supplier');
    }
}
