<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamersTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streamer_tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('streamer_id');
            $table->string('tag_id');
            $table->string('tag_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streamer_tags');
    }
}
