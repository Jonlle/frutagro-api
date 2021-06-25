<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'permission_role';

    /**
     * Run the migrations.
     * @table roles_permissions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->foreignId('role_id')->constrained()
                  ->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()
                  ->onDelete('cascade');

            $table->primary(['role_id', 'permission_id']);
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
