<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Repository\GenreRepository;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public $model;

    public function __construct(Genre $model){
        $this->model=new GenreRepository($model);
    }

    public function getCategory(){
        $cat = $this->model->getAll()->toArray();
        return view('category',[
            'categorys' => $cat
        ]);
    }

    public function songsCategory($id) {
        $song = $this->model->getCategorySongs($id) ;
        return view('categorySong',[
            'songs' => $song,
            'cat' => $id,
            'namePage' => 'Результат по категоріях'
        ]);
    }

    public function songsCategoryA(Request $request) {
        $song = $this->model->getCategorySongs($request->get('id'), $request->get('page')) ;
        return response($song);
    }
}
