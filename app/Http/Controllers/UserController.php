<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Users;
use App\Repository\UsersRepository;
use App\Services\Login\RememberMeExpiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\This;

class UserController extends Controller
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
        $request->validate();
    }

    public function registration(RegisterRequest  $request){
        $request->validate();
        $date=$request->all();
        Users::create($date);
        return redirect('toHome');
    }

    public function Logout(){
        Session::flush();
        Auth::logout();
        return redirect('toHome');
    }

}
