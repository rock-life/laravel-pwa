<?php

namespace App\Repository;

use App\Models\Artist;
use App\Models\SavedSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveSongRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $SS;

    public function __constructor(SavedSong $model){
        $this->SS=$model;
    }

    public function has(string $name)
    {
        // TODO: Implement has() method.
    }

    /**
     * @inheritDoc
     */
    public function get(string $name)
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function set(string $name, string $value)
    {
        // TODO: Implement set() method.
    }

    /**
     * @inheritDoc
     */
    public function clear(string $name)
    {
        // TODO: Implement clear() method.
    }

    public function setSaveSong($id_sing){
        $this->SS = new SavedSong();
        $this->SS->id_user = Auth::id();
        $this->SS->id_song = $id_sing;
        $this->SS->save();
    }

    public function delSaveSong($id_sing){
        $this->SS = SavedSong::query()
            ->where('id_user', '=', Auth::id())
            ->where('id_song', '=', $id_sing)
            ->delete();
    }
    public function isSaveSong($id_sing){
    $this->SS = SavedSong::query()
        ->where('id_user', '=', Auth::id())
        ->where('id_song', '=', $id_sing)
        ->get()->toArray();
    return $this->SS;
}

    public function getSaveSongs(){
        $result = $this->SS = SavedSong::query()
            ->join('song_variant', 'saved_song.id_song', '=', 'song_variant.id' )
            ->join('songs', 'song_variant.id_song', '=', 'songs.id' )
            ->join('artist','songs.id_artist', '=', 'artist.id' )
            ->join('form_of_writing', 'song_variant.id_form_of_writing', '=', 'form_of_writing.id' )
        ->where('saved_song.id_user', '=', Auth::id())
        ->get(['songs.id as id', 'songs.name as name','song_variant.id as id_song_variant' ,'artist.name as artist', 'artist.id as artistId', 'form_of_writing.name as form_of_writing' ,'form_of_writing.id as id_form_of_writing']);
        return $result->toArray();
    }
}
