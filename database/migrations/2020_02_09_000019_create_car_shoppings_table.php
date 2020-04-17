<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarShoppingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'car_shoppings';

    /**
     * Run the migrations.
     * @table car_shopping
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity');

            $table->index(["product_id"], 'fk_car_shopping_products_idx');
            $table->index(["user_id"], 'fk_car_shopping_user_idx');

            $table->foreignId('product_id')->constrained()
                  ->onDelete('cascade');

            $table->foreignId('user_id')->constrained()
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
