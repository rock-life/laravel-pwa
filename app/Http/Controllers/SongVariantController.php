<?php

namespace App\Http\Controllers;

use App\Models\SongVariant;
use App\Repository\FormOfWritingRepository;
use App\Repository\GenreRepository;
use App\Repository\SongVariantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongVariantController extends Controller
{

    public $model;
    public $genre;
    public $form;

    public function __construct(SongVariant $model){
        $this->model=new SongVariantRepository($model);
        $this->genre = new GenreRepository();
        $this->form = new FormOfWritingRepository();
    }

    public function canEdit(Request $request){
        if ($request->ajax()){
            return $this->model->canEdit($request->get('id'));
        }
    }

    public function getVariantSong(Request $request){
        try {
            if ($request->ajax()) {
                $typeValue = [];
                foreach ($this->model->getOpenVariantByIdType($request->get('id'), $request->get('type')) as $key => $variant) {
                    if (Auth::id() != null) {
                        if ($variant['id_user'] == Auth::id() || Auth::user()->id_role > 1) {
                            $typeValue += [$key++ => $variant['id']];
                        } else if ($variant['visibility'] == 1) {
                            $typeValue += [$key++ => $variant['id']];
                        }
                    } else {
                        if ($variant['visibility'] == 1) {
                            $typeValue += [$key++ => $variant['id']];
                        }
                    }
                }
                ini_set("log_errors", TRUE);
                ini_set('error_log', 'test.log');
                $messagelog =__FILE__.' - '.__LINE__.' :'. var_export($typeValue,true);
                error_log($messagelog);
                return response()->json($typeValue);
            }
        } catch (\Exception $exception){
            ini_set("log_errors", TRUE);
            ini_set('error_log', 'test.log');
            $messagelog =__FILE__.' - '.__LINE__.' :'. var_export($typeValue,true);
            error_log($messagelog);
            ini_set("log_errors", TRUE);
            ini_set('error_log', 'test.log');
            $messagelog =__FILE__.' - '.__LINE__.' :'.$exception->getMessage().$exception->getFile().$exception->getLine();
            error_log($messagelog);
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
        $song = $this->model->editSong($request);
        return redirect()->route(
            'getSong',
            [
                'id_song' => $song['id_song'],
                'id_song_variant' => $song['id'],
                'type' => $song['id_form_of_writing']
            ]
        );
    }

    public function editSongPage($id){
        $types = $this->form->getAll();
        $categorys = $this->genre->getAll();
        $result = $this->model->getSongVariant($id);
        return view('edit_song',[
            'data_song' => $result[0],
            'types' => $types,
            'categorys' => $categorys
        ]);
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
