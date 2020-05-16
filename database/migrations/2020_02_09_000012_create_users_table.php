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
            $table->string('username', 10)->unique();
            $table->string('doc_type_id', 3)->nullable();
            $table->string('role_id', 8);
            $table->string('status_id', 2);
            $table->string('name', 100);
            $table->string('document', 20)->nullable();
            $table->string('password', 64);
            $table->rememberToken();
            $table->timestamps();

            $table->index('doc_type_id');
            $table->index('role_id');
            $table->index('status_id');

            $table->foreign('doc_type_id')
                  ->references('id')->on('document_types')
                  ->onDelete('cascade');

            $table->foreign('role_id')
                  ->references('id')->on('roles')
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
