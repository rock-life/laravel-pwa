<?php

namespace App\Http\Controllers;

use App\Models\SongVariant;
use App\Repository\SongVariantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                if (Auth::id() != null) {
                    if($variant['id_user'] == Auth::id()){
                        $typeValue += [$key++ => $variant['id']];
                    } else if ($variant['visibility'] == 1){
                        $typeValue += [$key++ => $variant['id']];
                    }
                } else{
                    if ($variant['visibility'] == 1){
                        $typeValue += [$key++ => $variant['id']];
                    }
                }
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
