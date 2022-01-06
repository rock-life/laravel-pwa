<?php

namespace App\Repository;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UsersRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $users;

    public function __construct(Users $model){
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
}
