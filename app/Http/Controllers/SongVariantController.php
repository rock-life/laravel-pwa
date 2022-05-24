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

    public function delMyAddedSong(Request $request){
        if ($request->ajax() && Auth::id() != null) {
            try {
                $result = $this->model->delMyAddedSong($request->get('id'));
            } catch (\Exception $e){
                $result = $e->getMessage();
            }
            return response()->json(['result' => $result]);
        }
    }

    public function editMyAddedSong(Request $request){
        $request->validated();
        $song = $this->model->editSong($request);
        return redirect()->route(
            'getSong',
            [
                'id_song' => $song->id_song,
                'id_song_variant' => $song->id,
                'type' => $request->get('type')
            ]
        );
    }
}
