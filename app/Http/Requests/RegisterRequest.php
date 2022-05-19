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
                function($attribute, $value,$fail){
                    if(DB::table('users')->where('login',$value)->count('login')>0)
                        $fail('Логін існує!');
                }
            ],
            'email'=>[
                'required',
                'email',
                function($attribute,$value,$fail){
                    if(DB::table('users')->where('email', $value)->count()>0)
                        $fail('email існує');
                }
            ],
            'password' => [
                'required',
                'min:6',
            ],
            'repeat_password'=>'required|same:password',
        ];
    }
}
