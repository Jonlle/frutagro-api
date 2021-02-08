<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('icon_name')->default('far fa-share-square');
            $table->string('icon_size')->default('fa-2x');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('status_id', 2)->default('in');
            $table->timestamps();
        });

        Schema::table('social_media', function (Blueprint $table) {
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
        Schema::dropIfExists('social_media');
    }
}
