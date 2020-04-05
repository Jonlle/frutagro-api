<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'document_types';

    /**
     * Run the migrations.
     * @table document_types
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->string('id', 3);
            $table->string('status_id', 2);
            $table->string('description', 50);

            $table->primary('id');

            $table->index(["status_id"], 'fk_document_types_statuses_idx');

            $table->foreign('status_id', 'fk_document_types_statuses')
                  ->references('id')->on('statuses')
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
