<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table='genre_models';
    public $timestamps=false;

    public function song(){
        return $this->hasMany('App\Models\Songs');
    }
}
