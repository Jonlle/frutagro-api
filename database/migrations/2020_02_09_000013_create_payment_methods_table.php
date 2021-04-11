<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'payment_methods';

    /**
     * Run the migrations.
     * @table payment_methods
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('payment_type_id', 15);
            $table->string('reference_number', 25)->nullable();
            $table->unsignedBigInteger('financial_entity_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->index('payment_type_id');
            $table->index('financial_entity_id');
            $table->index('payment_id');

            $table->foreign('payment_type_id')
                  ->references('id')->on('payment_types')
                  ->onDelete('cascade');

            $table->foreign('financial_entity_id')
                  ->references('id')->on('financial_entities')
                  ->onDelete('cascade');

            $table->foreign('payment_id')
                  ->references('id')->on('payments')
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
