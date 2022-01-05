<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table='users';

    protected $fillable=[
        'login',
        'email',
        'id_role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
    'email_verified_at' => 'datetime',
];


    public function savedSong (){
        return $this->hasMany('App\Models\SavedSong');
    }

    public function songVariant (){
        return $this->hasMany('App\Models\SongVariant');
    }
    public function roles(){
        return $this->belongsTo('App\Models\Roles');
    }
}
