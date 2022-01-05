<?php

namespace App\Http\Controllers;

use App\Models\SongVariant;
use App\Repository\SongVariantRepository;
use Illuminate\Http\Request;

class SongVariantController extends Controller
{

    public $model;

    public function __construct(SongVariant $model){
        $this->model=new SongVariantRepository($model);
    }
}
