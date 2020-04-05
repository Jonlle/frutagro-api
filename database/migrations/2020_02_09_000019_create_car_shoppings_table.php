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
            // $table->unsignedInteger('product_id');
            // $table->unsignedInteger('user_id');
            $table->unsignedInteger('quantity');

            $table->index(["product_id"], 'fk_car_shopping_products_idx');
            $table->index(["user_id"], 'fk_car_shopping_user_idx');


            // $table->foreign('product_id', 'fk_car_shopping_products')
            //       ->references('id')->on('products')
            $table->foreignId('product_id')->constrained()
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            // $table->foreign('user_id', 'fk_car_shopping_user')
            //       ->references('id')->on('users')
            $table->foreignId('user_id')->constrained()
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
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
