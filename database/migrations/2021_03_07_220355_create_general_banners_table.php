<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_banners', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('title');
            $table->string('slug');
            $table->string('file_image')->default('frutagro_general_banner.svg');
            $table->string('file_path')->default('/images/generalBanners');
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
        Schema::dropIfExists('general_banners');
    }
}
