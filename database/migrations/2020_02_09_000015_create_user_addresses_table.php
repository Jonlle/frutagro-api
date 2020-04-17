<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_addresses';

    /**
     * Run the migrations.
     * @table user_address
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('address_type_id', 10);
            $table->string('address', 200);
            $table->timestamps();

            $table->index(["address_type_id"], 'fk_user_address_address_types_idx');
            $table->index(["user_id"], 'fk_user_address_users_idx');

            $table->foreign('address_type_id', 'fk_user_address_address_types')
                  ->references('id')->on('address_types')
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
