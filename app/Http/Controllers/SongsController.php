<?php

namespace App\Http\Controllers;

use App\Models\SongsModel;
use App\Repository\SongRepository;
use Illuminate\Http\Request;

class SongsController extends Controller
{

    public $model;

    public function __construct(SongsModel $model){
        $this->model=new SongRepository($model);
    }
}
