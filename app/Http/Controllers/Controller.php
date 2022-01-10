<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function toHome(){

        return view('home');
    }
    public function editLang(){
        if(session()->has('lang') && session()->get('lang')=='en')
        session()->put(['lang'=>'uk']);
        else if(session()->has('lang') && session()->get('lang')=='uk')
            session()->put(['lang'=>'en']);
        else
            session()->put(['lang'=>'uk']);
        App::setLocale(session()->get('lang'));
        return view('home');
    }
}
