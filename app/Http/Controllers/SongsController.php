<?php

namespace App\Http\Controllers;

use App\Models\Songs;
use App\Repository\FormOfWritingRepository;
use App\Repository\GenreRepository;
use App\Repository\SongRepository;
use Illuminate\Http\Request;

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


}
