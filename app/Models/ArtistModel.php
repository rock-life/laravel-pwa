<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistModel extends Model
{
    protected $table='artist_models';
    public function songs(){
        return $this->hasMany('App\Models\SongsModel');
    }
}
