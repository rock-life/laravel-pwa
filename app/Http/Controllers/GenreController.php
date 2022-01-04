<?php

namespace App\Http\Controllers;

use App\Models\GenreModel;
use App\Repository\GenreRepository;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public $model;

    public function __construct(GenreModel $model){
        $this->model=new GenreRepository($model);
    }
}
