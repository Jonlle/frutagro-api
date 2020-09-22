<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'product_attributes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()
                  ->onDelete('cascade');
            $table->string('sku', 10)->unique();
            $table->string('unit_name', 10);
            $table->float('unit_cant');
            $table->float('price');
            $table->unsignedInteger('stock')->nullable();
            $table->string('tags')->nullable();
            $table->string('status_id', 2)->default('av');
            $table->timestamps();

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
