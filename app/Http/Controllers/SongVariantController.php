<?php

namespace App\Http\Controllers;

use App\Models\SongVariantModel;
use App\Repository\SongVariantRepository;
use Illuminate\Http\Request;

class SongVariantController extends Controller
{

    public $model;

    public function __construct(SongVariantModel $model){
        $this->model=new SongVariantRepository($model);
    }
}
