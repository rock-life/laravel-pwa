<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registrationNewUser()
    {
        return view('registration');
    }

    public function validateRegistrationNewUser(Request $request){
            $request->validate([
                'login'=>'required||min:3|regex:#^[aA-zZ\-\_0-9]{4,}#u',
                'email'=>'required|email',
                    'password' => 'required|min:6|regex:#^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\d]){8,}#u',
                'repeat_password'=>'required|same:password',
                    'user_photo'=>'image'
            ]
        );
            $review= new UsersModel();
            $review->login=$request->input('login');
            $review->password=$request->input('password');
            $review->email=password_hash($request->input('email'),PASSWORD_ARGON2I);
            $review->save();
            return redirect()->route('home');
    }

    public function sidnInUser()
    {
        return view('sign_in');
    }
}
