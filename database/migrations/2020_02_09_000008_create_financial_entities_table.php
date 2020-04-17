<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialEntitiesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'financial_entities';

    /**
     * Run the migrations.
     * @table financial_entities
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('entity_name', 100);
            $table->string('status_id', 2);

            $table->unique('entity_name');

            $table->index(["status_id"], 'fk_financial_entities_statuses_idx');

            $table->foreign('status_id', 'fk_financial_entities_statuses')
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
