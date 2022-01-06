<?php

namespace App\Http\Controllers;

use App\Models\SavedSong;
use App\Repository\SaveSongRepository;
use Illuminate\Http\Request;

class SaveSongController extends Controller
{

    public $model;

    public function __construct(SavedSong $model){
        $this->model=new SaveSongRepository($model);
    }
}
