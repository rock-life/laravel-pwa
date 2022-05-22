<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Repository\ArtistRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArtistController extends Controller
{
    public $model;

    public function __construct(Artist $model){
        $this->model=new ArtistRepository($model);
    }

    public function getArtistByLetters(Request $request){
        if ($request->ajax()){
            $artistValue = [];
            if (!Cache::has('artist')) {
                foreach ($this->model->getAll() as $artist){
                    $artistValue += [$artist->id => $artist->name];
                }
                Cache::add('artist', $artistValue);
            }
            $artistValue = Cache::get('artist');
            $artistsResponse = [];
            foreach ($artistValue as $key => $name) {
                 if (stripos( $name, $request->get('name')) !== false) {
                     $artistsResponse += [
                         $key => $name
                     ];
                 }
            }
            return response()->json($artistsResponse);
        }
    }
}
