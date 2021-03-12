<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTextTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_text_tag', function (Blueprint $table) {
            $table->foreignId('information_text_id')->constrained()
                ->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()
                ->onDelete('cascade');

            $table->primary(['information_text_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information_text_tag');
    }
}
