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
        return view('registration');
    }

    public function validateRegistrationNewUser(Request $request){
            $this->model->saveNewUser($request);
            return redirect()->route('sign_in');
    }

    public function sidnInUser()
    {
        return view('sign_in');
    }
}
