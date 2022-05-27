<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repository\UsersRepository;
use App\Services\Login\RememberMeExpiration;
use Couchbase\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\This;

class UserController extends Controller
{
    protected $model;
    public function __construct(User $usersModel){
        $this->model=new UsersRepository($usersModel);
    }

    public function showRegisterForm(){
        return view('registration');
    }

    public function showLoginForm(){
        return view('sign_in');
    }



    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        return redirect('sign_in')->with('success', "Акаунт створено, будь-ласка увійдіть.");
    }

    public function Logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
        return redirect()->to('login')
            ->withErrors(trans('auth.failed'));
        endif;

        Auth::attempt($credentials);
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }

    public function manageUsers(){
        $usersList = $this->model->getUsers();
        return view('manage_users', ['users' => $usersList]);
    }
    public function manageUsersAjax(Request $request){
        if ($request->ajax()) {
            $usersList = $this->model->getUsers($request->get('page'));
            return response()->json(['users' => $usersList]);
        }
    }

    public function searchUsers(Request $request){
        $users = $this->model->getUser($request->get('search-value'));
        return view('manage_users', ['users' => $users]);
    }

}
