<?php

namespace App\Http\Controllers;

use App\Models\SavedSong;
use App\Repository\SaveSongRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveSongController extends Controller
{

    public $model;

    public function __construct(SavedSong $model){
        $this->model=new SaveSongRepository($model);
    }

    public function setSavedSong(Request $request){
        if ($request->ajax()){
            if(Auth::id() != null) {
                try {
                    $this->model->setSaveSong($request->get('id'));
                } catch (\Exception $e) {
                    return response()->json(['result' => $e->getMessage()]);
                }
                return response()->json(['result' => true]);
            }
        }
    }
    public function getSavedSong(Request $request){
        $result = $this->model->getSaveSongs();
        return view('saved_songs',[
            'songs' => $result
        ]);
    }
    public function delSavedSong(Request $request){
        if ($request->ajax()) {
            try {
                $this->model->delSaveSong($request->get('id'));
                return response()->json(['result' => true]);
            } catch (\Exception $e){
                return response()->json(['result' => $e->getMessage()]);
            }
        }
    }
}
