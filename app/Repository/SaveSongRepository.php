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

    public function getSaveSongs(){
        $result = $this->SS = SavedSong::query()
            ->join('songs', 'saved_song.id_song', '=', 'songs.id' )
            ->join('artist','songs.id_artist', '=', 'artist.id' )
        ->where('id_user', '=', Auth::id())
        ->get(['saved_song.id_song as id', 'songs.name as name', 'artist.name as artist']);
        return $result->toArray();
    }
}
