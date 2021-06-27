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
            $table->string('reference_number', 25)->nullable();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->string('payment_type_id', 15);

            $table->foreign('payment_type_id')
                ->references('id')->on('payment_types')
                ->onDelete('cascade');
            $table->foreignId('financial_entity_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('payment_id')
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
