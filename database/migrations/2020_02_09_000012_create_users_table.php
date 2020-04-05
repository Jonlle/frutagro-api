<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('username', 10);
            $table->string('doc_type_id', 3);
            $table->string('role_id', 6);
            $table->string('status_id', 2);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('document', 20);
            $table->string('password', 64);
            $table->rememberToken();
            $table->timestamps();

            $table->unique('username');

            $table->index(["doc_type_id"], 'fk_users_document_types');
            $table->index(["role_id"], 'fk_users_roles_idx');
            $table->index(["status_id"], 'fk_users_statuses_idx');

            $table->foreign('doc_type_id', 'fk_users_document_types')
                  ->references('id')->on('document_types')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('role_id', 'fk_users_roles')
                  ->references('id')->on('roles')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('status_id', 'fk_users_statuses')
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
