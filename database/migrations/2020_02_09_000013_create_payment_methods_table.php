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
            $table->string('payment_type_id', 10);
            $table->string('reference_id', 25);

            $table->index(["financial_entity_id"], 'fk_payment_methods_financial_entity_idx');
            $table->index(["payment_type_id"], 'fk_payment_methods_payment_types_idx');
            $table->index(["payment_id"], 'fk_payments_methods_payment_idx');

            $table->foreignId('financial_entity_id')->constrained()
                  ->onDelete('cascade');

            $table->foreignId('payment_id')->constrained()
                  ->onDelete('cascade');

            $table->foreign('payment_type_id', 'fk_payment_methods_payment_types')
                  ->references('id')->on('payment_types')
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
