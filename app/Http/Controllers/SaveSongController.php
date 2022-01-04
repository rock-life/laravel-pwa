<?php

namespace App\Http\Controllers;

use App\Models\SaveSongModel;
use App\Repository\SaveSongRepository;
use Illuminate\Http\Request;

class SaveSongController extends Controller
{

    public $model;

    public function __construct(SaveSongModel $model){
        $this->model=new SaveSongRepository($model);
    }
}
