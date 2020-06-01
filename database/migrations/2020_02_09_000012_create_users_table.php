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
            $table->string('role_id', 8);
            $table->string('status_id', 2)->default('ac');
            $table->string('name', 100);
            $table->string('doc_type_id', 3)->nullable();
            $table->string('document', 20)->nullable();
            $table->string('password', 64);
            $table->string('avatar')->default('avatar.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index('role_id');
            $table->index('status_id');
            $table->index('doc_type_id');

            $table->foreign('role_id')
                  ->references('id')->on('roles')
                  ->onDelete('cascade');

            $table->foreign('status_id')
                  ->references('id')->on('statuses')
                  ->onDelete('cascade');

            $table->foreign('doc_type_id')
                  ->references('id')->on('document_types')
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
