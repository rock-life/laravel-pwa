<?php

namespace App\Repository;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Songs;
use Illuminate\Http\Request;

class GenreRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $genre;

    public function __constructor(Genre $model){
        $this->genre=$model;
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

    public function getAll()
    {
        return Genre::all();
    }

    public function getCategorySongs($id, $page = 0)
    {
        return Songs::query()
            ->join('song_variant', 'song_variant.id_song', '=', 'songs.id')
            ->join('form_of_writing', 'form_of_writing.id', '=', 'song_variant.id_form_of_writing')
            ->join('artist', 'artist.id', '=', 'songs.id_artist')
            ->where('song_variant.visibility', '=', true)
            ->where('songs.id_genre', '=', $id)
            ->orderBy('songs.id')
            ->skip($page * 10)
            ->take(10)
            ->get(['songs.id as id', 'songs.name as name', 'artist.id as artistId','song_variant.id as variantId', 'artist.name as artistName', 'form_of_writing.id as id_form_of_writing', 'form_of_writing.name as name_form_of_writing'])
            ->toArray();
    }
}
