<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongsModel extends Model
{
    protected $table='songs_models';
    public $timestamps=false;
    public function saveSong(){
        return $this->hasMany('App\Models\SaveSongModel');
    }
    public function songVariant(){
        return $this->hasMany('App\Models\SongVariantModel');
    }
    public function artist(){
        return $this->belongsTo('App\Models\ArtistModel');
    }
    public function genre(){
        return $this->hasMany('App\Models\GenreModel');
    }

}
