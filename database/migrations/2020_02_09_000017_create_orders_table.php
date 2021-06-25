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
            $table->string('status_id', 2)->default('pe');
            $table->foreignId('user_id')->constrained()
                  ->onDelete('cascade');
            $table->foreignId('user_address_id')->constrained()
                  ->onDelete('cascade');
            $table->foreignId('payment_id')->constrained()
                  ->onDelete('cascade');
            $table->foreignId('delivery_method_id')->constrained()
                  ->onDelete('cascade');
            $table->text('commentary')->nullable();
            $table->decimal('grand_total', 20, 2);
            $table->unsignedInteger('item_count');
            $table->timestamps();

            $table->index('status_id');
            $table->index("user_id");
            $table->index("user_address_id");
            $table->index("payment_id");
            $table->index("delivery_method_id");

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
