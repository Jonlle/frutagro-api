<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('bank_data', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type_id');               //tipo de pago (pago movil o transferencia)
            $table->unsignedBigInteger('financial_entity_id')->nullable(); //banco
            $table->unsignedBigInteger('supplier_id')->nullable();  //proveedor
            $table->string('target_acount')->nullable();   //numero de telf o numero de cuenta
            $table->string('document_type_id', 3)->nullable();  //tipo de documento (rif, ci, etc)
            $table->string('document', 20)->nullable();    //numero de identificacion
            $table->string('target_name')->nullable();     //nombre de la persona destino
            $table->string('file_image')->nullable();      //Imagen refente al banco
            $table->string('file_path')->nullable();       //Path de la imagen referente al banco
            $table->string('status_id', 2)->default('en');
            $table->timestamps();
        });

        Schema::table('bank_data', function (Blueprint $table) {
            $table->foreign('payment_type_id')
                  ->references('id')->on('payment_types')
                  ->onDelete('cascade');

            $table->foreign('financial_entity_id')
                  ->references('id')->on('financial_entities')
                  ->onDelete('cascade');

            $table->foreign('supplier_id')
                  ->references('id')->on('suppliers')
                  ->onDelete('cascade');

            $table->foreign('document_type_id')
                  ->references('id')->on('document_types')
                  ->onDelete('cascade');

            $table->foreign('status_id')
                  ->references('id')->on('statuses')
                  ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_data');
    }
}
