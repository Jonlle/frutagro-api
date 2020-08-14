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
            $table->string('status_id', 2)->default('ac');
            $table->string('supplier_name', 40);
            $table->string('contact_name', 40);
            $table->string('contact_title', 30);
            $table->string('address', 200);
            $table->string('code_postal', 5);
            $table->string('city', 50);
            $table->string('country', 15);
            $table->string('phone', 11);
            $table->string('fax', 11)->nullable();
            $table->string('email', 50)->unique();
            $table->timestamps();

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
