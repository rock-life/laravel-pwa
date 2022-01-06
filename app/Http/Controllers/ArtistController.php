<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Repository\ArtistRepository;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public $model;

    public function __construct(Artist $model){
        $this->model=new ArtistRepository($model);
    }
}
