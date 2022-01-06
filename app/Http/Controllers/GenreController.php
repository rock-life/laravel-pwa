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
}
