<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongVariantModel extends Model
{
    protected $table='song_variant_models';
    public function song(){
       return $this->belongsTo('App\Models\SongsModel');
    }
    public function form_to_writing (){
        return $this->belongsTo('App\Models\FormOfWritingModel');
    }
    public function user (){
        return $this->belongsTo('App\Models\UsersModel');
    }
}
