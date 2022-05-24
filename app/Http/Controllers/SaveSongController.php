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
                    $this->model->setSaveSong($request->get('id_song'));
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
                $this->model->gelSaveSongs($request->get('id_song'));
                return response()->json(['result' => true]);
            } catch (\Exception $e){
                return response()->json(['result' => $e->getMessage()]);
            }
        }
    }
}
