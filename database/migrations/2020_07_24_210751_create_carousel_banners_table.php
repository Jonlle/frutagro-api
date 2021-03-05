<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselBannersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'carousel_banners';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_color')->default('rgb(64, 73, 59)');
            $table->text('description');
            $table->string('description_color')->default('rgb(64, 73, 59)');
            $table->string('file_image')->default('frutagro_carousel_banner.svg');
            $table->string('file_path')->default('/images/carouselBanners');
            $table->string('status_id', 2)->default('en');
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
        Schema::dropIfExists('banners');
    }
}
