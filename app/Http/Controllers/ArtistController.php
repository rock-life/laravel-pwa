<?php

namespace App\Http\Controllers;

use App\Models\ArtistModel;
use App\Repository\ArtistRepository;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public $model;

    public function __construct(ArtistModel $model){
        $this->model=new ArtistRepository($model);
    }
}
