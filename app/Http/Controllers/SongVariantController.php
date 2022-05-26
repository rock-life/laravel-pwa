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

    public function editSongPage($id){
        $result = $this->model->getSongVariant($id);
        return view('edit_song',['data_song' => $result]);
    }

    public function editSongVisibility(Request $request){
        if ($request->ajax()) {
            try {
                $this->model->editSongVisibility($request->get('id'));
                return response()->json(['result' => true]);
            } catch (\Exception $e){
                return response()->json(['result' => $e->getMessage()]);
            }

        }
    }

    public function getModSongs(){
        $songs = $this->model->getModSongs();
        return view('management_song', ['songs' => $songs]);
    }
    public function getModSongsAjax(Request $request){
        if ($request->ajax()) {
            $songs = $this->model->getModSongs($request->get('page'));
            return response()->json(['songs' => $songs]);
        }
    }
}
