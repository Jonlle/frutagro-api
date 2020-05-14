<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'suppliers';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('status_id', 2);
            $table->string('supplier_name', 40);
            $table->string('contact_name', 40);
            $table->string('contact_title', 30);
            $table->string('address', 200);
            $table->string('code_postal', 10);
            $table->string('city', 15);
            $table->string('country', 15);
            $table->string('phone', 11);
            $table->double('fax', 11);
            $table->double('email', 50);

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
        Schema::dropIfExists('suppliers');
    }
}
