<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Users extends User
{
    protected $table='users';

    protected $fillable=[
        'login',
        'email',
        'password',
        'id_role'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
    'email_verified_at' => 'datetime',
];

    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
    }


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
