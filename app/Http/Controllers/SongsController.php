<?php

namespace App\Http\Controllers;

use App\Models\Songs;
use App\Repository\SongRepository;
use Illuminate\Http\Request;

class SongsController extends Controller
{

    public $model;

    public function __construct(Songs $model){
        $this->model=new SongRepository($model);
    }
}
