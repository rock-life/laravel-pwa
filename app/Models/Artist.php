<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table='artist';
    public function songs(){
        return $this->hasMany('App\Models\Songs');
    }
}
