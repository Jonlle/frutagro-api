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
            // $table->increments('id');
            $table->string('role_id', 6);

            $table->index(["role_id"], 'fk_permission_role_roles_idx');

            $table->foreign('role_id', 'fk_permission_role_roles')
                  ->references('id')->on('roles')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            // $table->foreign('permission_id', 'fk_permission_role_permissions')
            //       ->references('id')->on('permissions')
            $table->foreignId('permission_id')->constrained()
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->index(["permission_id"], 'fk_permission_role_permissions_idx');

            $table->index(['role_id', 'permission_id']);
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
