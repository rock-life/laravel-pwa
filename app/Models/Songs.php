<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    protected $table='songs_models';
    public $timestamps=false;
    public function saveSong(){
        return $this->hasMany('App\Models\SavedSong');
    }
    public function songVariant(){
        return $this->hasMany('App\Models\SongVariant');
    }
    public function artist(){
        return $this->belongsTo('App\Models\Artist');
    }
    public function genre(){
        return $this->hasMany('App\Models\Genre');
    }

}
