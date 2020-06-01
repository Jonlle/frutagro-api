<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPhonesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_phones';

    /**
     * Run the migrations.
     * @table user_phones
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('phone_number', 11);
            $table->string('status_id', 2)->default('ac');
            $table->string('principal', 1);
            $table->timestamps();

            $table->unique('phone_number');

            $table->index(["user_id"], 'fk_user_phones_users_idx');
            $table->index(["status_id"], 'fk_user_phones_statuses_idx');

            $table->foreign('status_id', 'fk_user_phones_statuses')
                  ->references('id')->on('statuses')
                  ->onDelete('cascade');

            $table->foreignId('user_id')->constrained()
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
