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
            // $table->unsignedInteger('payment_id');
            $table->string('status_id', 2);
            // $table->unsignedInteger('user_id');
            $table->date('order_date');
            $table->date('date_processed');
            $table->string('address_to_send', 200);

            $table->index(["payment_id"], 'fk_orders_payments_idx');
            $table->index(["status_id"], 'fk_orders_statuses_idx');
            $table->index(["user_id"], 'fk_orders_users_idx');

            // $table->foreign('payment_id', 'fk_orders_payments')
            //       ->references('id')->on('payments')
            $table->foreignId('payment_id')->constrained()
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('status_id', 'fk_orders_statuses')
                  ->references('id')->on('statuses')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            // $table->foreign('user_id', 'fk_orders_users')
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
