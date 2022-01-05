<?php

namespace App\Http\Controllers;

use App\Models\FormOfWriting;
use App\Repository\FormOfWritingRepository;
use Illuminate\Http\Request;

class FormOfWritingController extends Controller
{

    public $model;

    public function __construct(FormOfWriting $model){
        $this->model=new FormOfWritingRepository($model);
    }
}
