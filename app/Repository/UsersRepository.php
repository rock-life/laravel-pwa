<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UsersRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $users;

    public function __construct(User $model){
        $this->users=$model;
    }

    public function signIn(Request  $request){
        $us = Db::table('users_models')->where('login',$request->input('login') )->first();

        $request->validate(
            [
                'login'=>[
                    'required',
                    function($attribute,$value,$fail) use ($us){
                        if( isset($us->login)==false)
                            $fail('incorrect login!');
                    }
                ],
                'password'=>[
                    'required',
                    function($attribute,$value,$fail) use ($us) {
                        if( isset($us->password)==false)
                            $fail('incorrect password!');
                        else if (password_verify($value,$us->password)==true)
                            session(['is_sign_in'=>true]);
                        else
                            $fail('incorrect password!');
                    }
                ]
            ]
        );
        #$user = Db::table('users_models')->where('login',$request->input('login') )->first();
        #
    }



    public function has(string $name)
    {
        // TODO: Implement has() method.
    }

    /**
     * @inheritDoc
     */
    public function get(string $name)
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function set(string $name, string $value)
    {
        // TODO: Implement set() method.
    }

    /**
     * @inheritDoc
     */
    public function clear(string $name)
    {
        // TODO: Implement clear() method.
    }

    public function getUsers($page = 0)
    {
      return User::query()
          ->join('roles', 'roles.id', '=', 'users.id_role')
          ->orderBy('id', 'desc')
          ->skip($page * 10)
          ->take( 10)
          ->get(['user.id as id',' user.login as login', 'user.email as email', 'roles.id as rolesId, roles.name as role '])->toArray();
    }
    public function getModSongs($page = 0){
        return SongVariant::query()
            ->join('songs', 'songs.id', 'song_variant.id_song')
            ->join('artist', 'artist.id', 'songs.id_artist')
            ->join('form_of_writing', 'song_variant.id_form_of_writing', 'form_of_writing.id')
            ->orderBy('id', 'desc')
            ->skip($page * 10)
            ->take( 10)
            ->get(['id','songs.name as name','artist.name as artist', 'song_variant.visibility'])
            ->toArray();
    }

    public function getUser($value): array
    {
        return User::query()
            ->join('roles', 'roles.id', '=', 'users.id_role')
            ->where('login', 'like', $value)
            ->orWhere('email', 'like', $value)
            ->get(['user.id as id',' user.login as login', 'user.email as email', 'roles.id as rolesId, roles.name as role '])->toArray();

    }
}
