<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'permissions';

    /**
     * Run the migrations.
     * @table permissions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('status_id', 2);

            $table->index(["status_id"], 'fk_permissions_statuses_idx');

            $table->foreign('status_id', 'fk_permissions_statuses')
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
