<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'orders';

    /**
     * Run the migrations.
     * @table orders
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 13)->unique();
            $table->text('commentary')->nullable();
            $table->decimal('grand_total', 20, 2);
            $table->unsignedInteger('item_count');
            $table->timestamps();
        });


        Schema::table($this->tableName, function (Blueprint $table) {
            $table->string('status_id', 2)->default('pe');

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('user_address_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('delivery_method_id')
                ->constrained()
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
