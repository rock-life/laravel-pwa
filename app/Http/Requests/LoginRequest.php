<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $us=DB::table('users')->where('login',$this->input('login'))->get()->first();
        return [
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
        ];
    }

    public  function getCredentials(){
        $login=$this->get('login');

        if($this->isEmail($login)){
            return [
                'email'=>$login,
                'password'=>$this->get('password')
            ];
        }

        return  $this->only('login', 'password');
    }

    public function isEmail($param){
        $factory=$this->container->make(ValidationFactory::class);

        return ! $factory->make(
            ['login'=>$param],
            ['login'=>'email']
        )->fail();
    }


}
