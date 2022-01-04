<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveSongModel extends Model
{
public $timestamps=false;

protected $table='save_song_models';
    public function user(){
        return $this->belongsTo('App\Models\UsersModel');
    }
    public function songs(){
        return $this->belongsTo('App\Models\SongsModel');
    }

}
