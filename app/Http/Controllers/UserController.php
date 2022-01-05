<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use App\Repository\UsersRepository;
use Illuminate\Http\Request;

class
UserController extends Controller
{
    protected $model;
    public function __construct(UsersModel $usersModel){
        $this->model=new UsersRepository($usersModel);
    }

    public function registrationNewUser()
    {
        if(session('is_sign_in')==false)
            return view('registration');
        else
            return view('home');
    }

    public function ExitUser (){
        session(['is_sign_in'=>false]);
        return view('home');
    }

    public function validateRegistrationNewUser(Request $request){
                $this->model->saveNewUser($request);
                return redirect()->route('sign_in');
    }
    public function validateSignInUser(Request $request){
        if(session('is_sign_in')==false) {
            $this->model->signIn($request);
            return redirect()->route('home');
        }
        else
            return redirect()->route('home');
    }

    public function sidnInUser()
    {
        if(session('is_sign_in')==false)
            return view('sign_in');
        else
            return view('home');
    }
}
