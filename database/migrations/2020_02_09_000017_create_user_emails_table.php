<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEmailsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_emails';

    /**
     * Run the migrations.
     * @table user_emails
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('email', 50);
            $table->string('status_id', 2);
            // $table->unsignedInteger('user_id');
            $table->string('principal', 1);
            $table->timestamps();

            $table->unique('email');

            $table->index(["status_id"], 'fk_user_emails_statuses_idx');
            $table->index(["user_id"], 'fk_user_emails_users_idx');

            $table->foreign('status_id', 'fk_user_emails_statuses')
                  ->references('id')->on('statuses')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            // $table->foreign('user_id', 'fk_user_emails_users')
            //       ->references('id')->on('users')
            $table->foreignId('user_id')->constrained()
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
