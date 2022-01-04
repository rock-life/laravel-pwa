<?php

namespace App\Http\Controllers;

use App\Models\FormOfWritingModel;
use App\Repository\FormOfWritingRepository;
use Illuminate\Http\Request;

class FormOfWritingController extends Controller
{

    public $model;

    public function __construct(FormOfWritingModel $model){
        $this->model=new FormOfWritingRepository($model);
    }
}
