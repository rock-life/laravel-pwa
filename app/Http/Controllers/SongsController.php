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

    public function getSong($id_song, $id_song_variant,$type) {
        $types = $this->form->getAll();
        $songDetail = $this->model->getVariantSong($id_song, $id_song_variant, $type);
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

    public function getMyAddedSong(){
        $data = $this->model->getMyAddedSong();
        return view('my_added_song', ['result' => $data]);
    }
}
