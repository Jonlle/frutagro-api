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
            $table->string('email', 50)->unique();
            $table->string('status_id', 2)->default('ac');
            $table->foreignId('user_id')->constrained()
                  ->onDelete('cascade');
            $table->string('principal', 1);
            $table->timestamps();

            $table->index('status_id');
            $table->index('user_id');

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
