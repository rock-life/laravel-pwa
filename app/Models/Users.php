<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.
    }

    public function getAuthIdentifier()
    {
        // TODO: Implement getAuthIdentifier() method.
    }

    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
