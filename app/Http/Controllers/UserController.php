<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Users;
use App\Repository\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\This;

class
UserController extends Controller
{
    protected $model;
    public function __construct(Users $usersModel){
        $this->model=new UsersRepository($usersModel);
    }

    public function showRegisterForm(){
        return view('registration');
    }

    public function showLoginForm(){
        return view('sign_in');
    }

    public function login(LoginRequest $request){
        $credentials=$request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('sign_in')->withErrors(trans('auth.failed'));
        endif;

        $user=Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);

    }

    public function register(RegisterRequest $request){
        $user=Users::create($request->validated());
        auth()->login($user);
        return redirect('/');
    }

    public function authenticated (){
        return redirect()->intended();
    }


    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('sign_in');
    }

}
