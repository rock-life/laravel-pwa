<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class RegisterRequest extends FormRequest
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
        return [
            'login'=>['required',
                'min:3',
                'regex:#^[aA-zZ\-\_0-9]{4,}#u',
                function($attribute, $value,$fail){
                    if(DB::table('users')->where('login',$value)->count('login')>0)
                        $fail('Login is exists!');
                }
            ],
            'email'=>[
                'required',
                'email',
                function($attribute,$value,$fail){
                    if(DB::table('users')->where('email', $value)->count()>0)
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
        ];
    }
}
