<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table='users_models';
    public function saveSong (){
        return $this->hasMany('App\Models\SaveSongModel');
    }

    public function songVariant (){
        return $this->hasMany('App\Models\SongVariantModel');
    }
}
