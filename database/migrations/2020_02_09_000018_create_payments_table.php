<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'payments';

    /**
     * Run the migrations.
     * @table payments
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 20, 2);
            $table->timestamps();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->string('status_id', 2)->default('pe');

            $table->foreign('status_id')
                ->references('id')->on('statuses')
                ->onDelete('cascade');
            $table->foreignId('order_id')
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
