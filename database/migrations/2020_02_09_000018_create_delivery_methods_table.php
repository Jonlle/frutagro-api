<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMethodsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'delivery_methods';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->unique();
            $table->unsignedDecimal('price', 11, 2);
            $table->string('description')->nullable();
            $table->string('status_id', 2)->default('en');
            $table->timestamps();
        });

        Schema::table($this->tableName, function (Blueprint $table) {
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
        Schema::dropIfExists('delivery_methods');
    }
}
