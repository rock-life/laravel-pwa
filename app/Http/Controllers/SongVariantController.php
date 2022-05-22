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

    public function getVariantSong(Request $request){
        if ($request->ajax()){
            $typeValue = [];
            foreach ($this->model->getOpenVariantByIdType($request->get('id'),$request->get('type')) as $key => $variant){
                $typeValue += [$key++ => $variant['id']];
            }
            return response()->json($typeValue);
        }
    }

    public function getVariantTextSong(Request $request){
        if ($request->ajax()){
            $typeValue = $this->model->getOpenVariantById($request->get('id'));
            return response()->json($typeValue);
        }
    }
}
