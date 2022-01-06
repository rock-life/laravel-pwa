<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongVariantModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('song_variant', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('text');
            $table->string('image');
            $table->boolean('visibility');
        });
        Schema::table('song_variant', function (Blueprint $table){
           $table->foreignId('id_song') ->constrained('songs');
           $table->foreignId('id_form_of_writing')->constrained('form_of_writing');
           $table->foreignId('id_user')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_variant');
    }
}
