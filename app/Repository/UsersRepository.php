<?php

namespace App\Repository;

use App\Models\UsersModel;
use Illuminate\Http\Request;
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
                    Rule::exists('users_models','login')
                            ],
                'email'=>[
                    'required',
                    'email'
                ],
                'password' => [
                    'required',
                    'min:6',
                    'regex:#^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\d]){8,}#u'
                ],
                'repeat_password'=>'required|same:password',
                'user_photo'=>'image'
            ],
            [
                'login.exists'=>'Login exists!'
            ]
        );
        $this->users->login=$request->input('login');
        $this->users->password=password_hash($request->input('password'),PASSWORD_ARGON2I);
        $this->users->email=$request->input('email');
        $this->users->save();
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
