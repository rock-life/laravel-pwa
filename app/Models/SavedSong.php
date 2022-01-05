<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedSong extends Model
{
public $timestamps=false;

protected $table='saved_song';
    public function user(){
        return $this->belongsTo('App\Models\Users');
    }
    public function songs(){
        return $this->belongsTo('App\Models\Songs');
    }

}
