<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPaymentMethodsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'admin_payment_methods';

    /**
     * Run the migrations.
     * @table admin_payment_methods
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('payment_type_id');
            $table->unsignedBigInteger('bank_data_id')->nullable();
            $table->string('status_id', 2)->default('en');
            $table->timestamps();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
            $table->foreign('payment_type_id')
                  ->references('id')->on('payment_types')
                  ->onDelete('cascade');

            $table->foreign('bank_data_id')
                  ->references('id')->on('bank_data')
                  ->onDelete('cascade');

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
