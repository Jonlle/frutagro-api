<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_about_us', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('title');
            $table->string('info_text');
            $table->string('file_image')->nullable();
            $table->string('file_path')->default('/images/aboutUs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_about_us');
    }
}
