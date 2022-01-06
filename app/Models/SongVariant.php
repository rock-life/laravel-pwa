<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongVariant extends Model
{
    protected $table='song_variant_models';
    public function song(){
       return $this->belongsTo('App\Models\Songs');
    }
    public function form_to_writing (){
        return $this->belongsTo('App\Models\FormOfWriting');
    }
    public function user (){
        return $this->belongsTo('App\Models\Users');
    }
}
