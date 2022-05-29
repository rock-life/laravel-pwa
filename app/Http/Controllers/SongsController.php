<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongRequest;
use App\Models\Songs;
use App\Repository\FormOfWritingRepository;
use App\Repository\GenreRepository;
use App\Repository\SongRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongsController extends Controller
{

    public $model;
    public $genre;
    public $form;

    public function __construct(Songs $model){
        $this->model=new SongRepository($model);
        $this->genre = new GenreRepository();
        $this->form = new FormOfWritingRepository();
    }

    public function getPageAddNewSong()
    {
        $types = $this->form->getAll();
        $categorys = $this->genre->getAll();
        return view('new_song',
        [
            'action' => 'Додати',
            'types' => $types,
            'categorys' => $categorys
        ]);
    }

    public function addSongs(SongRequest $request){
        $request->validated();
        $song = $this->model->addNewSong($request);
        return redirect()->route(
            'getSong',
            [
                'id_song' => $song->id_song,
                'id_song_variant' => $song->id,
                'type' => $request->get('type')
            ]
        );
    }

    public function getSongShow($id_song){
        $types = $this->form->getAll();
        $songDetail = $this->model->getVariantSong($id_song);
        $song = $songDetail['id_song'];
        if ($songDetail['visibility'] == false && $songDetail['id_user'] == Auth::id()) {
            $name = $song['name'];
            $artist = $song['id_artist'];
            $text = $songDetail['text'];
            $idSong = $id_song;
            $idOthersVariants = $songDetail['otherVariant'] ?? $songDetail['id'];
        } else if ($songDetail['visibility'] == true) {
            $name = $song['name'];
            $artist = $song['id_artist'];
            $text = $songDetail['text'];
            $idSong = $id_song;
            $idOthersVariants = $songDetail['otherVariant'] ?? $songDetail['id'];
        } else {
            abort('404');
        }
        return view('open_song',
            [
                'id_user' => $songDetail['id_user'],
                'songDetail' => $songDetail,
                'types' => $types,
                'name' => $name,
                'artist' => $artist,
                'text' => $text,
                'idSong' => $idSong,
                'OthersVariant' => $idOthersVariants
            ]);
    }

    public function getSong($id_song, $id_song_variant,$type) {
        $types = $this->form->getAll();
        $songDetail = $this->model->getVariantSong($id_song, $id_song_variant, $type);
        $song = $songDetail['id_song'];
        if ($songDetail['visibility'] == false && $songDetail['id_user'] == Auth::id() || Auth::user()->id_role > 1) {
            $name = $song['name'];
            $artist = $song['id_artist'];
            $text = $songDetail['text'];
            $idSong = $id_song;
            $idOthersVariants = $songDetail['otherVariant'] ?? $songDetail['id'];
        } else if ($songDetail['visibility'] == true) {
            $name = $song['name'];
            $artist = $song['id_artist'];
            $text = $songDetail['text'];
            $idSong = $id_song;
            $idOthersVariants = $songDetail['otherVariant'] ?? $songDetail['id'];
        } else {
            abort('404');
        }

        if (Auth::id() == null) {
            return view('home',['message' =>  "Пісня додана і найближчим часом буде розглянута нашим адміністратором."]);
        }
        return view('open_song',
                    [
                        'songDetail' => $songDetail,
                        'types' => $types,
                        'name' => $name,
                        'artist' => $artist,
                        'text' => $text,
                        'idSong' => $idSong,
                        'OthersVariant' => $idOthersVariants
                    ]);
    }

    public function getSongPage(){
        $song = $this->model->getAllSongsFrom(0) ;
        return view('songs',[
            'songs' => $song,
            'namePage' => 'Усі пісні'
        ]);
    }
    public function getSongPageAjax(Request $request){
        if ($request->ajax()){
            ini_set("log_errors", TRUE);
            ini_set('error_log', 'test.log');
            $messagelog =__FILE__.' - '.__LINE__.' :'.var_export(6,true);
            error_log($messagelog);
            try {
                $song = $this->model->getAllSongsFrom($request->get('page')) ;
                return response($song);
            } catch (\Exception $e){
                return response($e->getMessage());
            }

        }
}


    public function getMyAddedSong(){
        $data = $this->model->getMyAddedSong();
        return view('my_added_song', ['result' => $data]);
    }

    public function search(Request $request){
        $song = $this->model->getSearchSongsFrom($request->get('search-value')) ;
        return view('songs',[
            'songs' => $song,
            'namePage' => 'Результат пошуку'
        ]);
    }
    public function songsArtist($id){
    $song = $this->model->getArtistSongs($id) ;
    return view('songs',[
        'songs' => $song,
        'namePage' => 'Результат пошуку'
    ]);
}

}
