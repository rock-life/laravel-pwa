<?php

namespace App\Repository;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UsersRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $users;

    public function __construct(UsersModel $model){
        $this->users=$model;
    }

    public function saveNewUser(Request $request){
$request->validate([
    'login'=>['required',
        'min:3',
        'regex:#^[aA-zZ\-\_0-9]{4,}#u',
        function($attribute, $value,$fail){
            if(DB::table('users_models')->where('login',$value)->count('login')>0)
                $fail('Login is exists!');
        }
    ],
    'email'=>[
        'required',
        'email',
        function($attribute,$value,$fail){
            if(DB::table('users_models')->where('email', $value)->count()>0)
                $fail('email is exists');
        }
    ],
    'password' => [
        'required',
        'min:6',
        'regex:#^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\d]){8,}#u'
    ],
    'repeat_password'=>'required|same:password',
    'user_photo'=>'image'
]
);
        $this->users->login=$request->input('login');
        $this->users->password=password_hash($request->input('password'),PASSWORD_ARGON2I);
        $this->users->email=$request->input('email');
        $this->users->save();
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
