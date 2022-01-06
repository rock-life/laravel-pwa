<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormOfWriting extends Model
{
    protected $table='form_of_writing_models';
    public $timestamps=false;
    public function songVariant(){
        return $this->hasMany('App\Models\Songs');
    }

}
