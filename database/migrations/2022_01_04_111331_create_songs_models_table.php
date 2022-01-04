<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::table('songs_models', function (Blueprint $table){
            $table->foreignId('id_artist')->constrained('artist_models');
            $table->foreignId('id_genre')->constrained('genre_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs_models');
    }
}
