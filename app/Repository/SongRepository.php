<?php

namespace App\Repository;

use App\Models\Artist;
use App\Models\Songs;
use App\Models\SongVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\s;

class SongRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $Song;

    public function __constructor(Songs $model){
        $this->Song=$model;
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

    public function addNewSong ($data){
       $songId = $this->isSongExcist($data);
       $songVariant = new SongVariant();
       $songVariant->text = $data->get('text-edit-song');
       $songVariant->visibility = false;
        $songVariant->video_of_song = $data->get('url_song');
        $songVariant->video_lesson = $data->get('url_lesson');
        $songVariant->id_song = $songId;
        $songVariant->id_form_of_writing = $data->get('type');
        Auth::id() != null & $songVariant->id_user = Auth::id();
        $songVariant->save();
        return $songVariant;
    }

    private function isArtistExcist($name){
        $artist = Artist::query()
            ->where('name', 'like', "%{$name}%")
            ->first();
        if ($artist == null) {
            $artist = new Artist();
            $artist->name = $name;
            $artist->save();
        }
        return $artist->id;
    }

    private function isSongExcist($data){
        $idArtist = $this->isArtistExcist($data->get('artist'));
        $song = Songs::query()
            ->where('name', 'like', "%{$data->get('name')}%")
            ->where('id_artist', '=', $idArtist)
            ->first();
        if ($song == null) {
            $song = new Songs();
            $song->name = $data->get('name');
            $song->id_artist = $idArtist;
            $song->id_genre = $data->get('category');
            $song->save();
        }
        return $song->id;
    }

    public function getVariantSong($idSong, $idVariantSong = 0, $type = 1){
        $this->Song = Songs::query()
            ->where('id', '=', $idSong)
            ->first();
        if($idVariantSong == 0){
            $variantSong = SongVariant::query()
//                ->where('id', '=', $idVariantSong)
                ->where('visibility', '=', 1)
                ->where('id_song', '=', $idSong)
                ->first();
            if (Auth::id()==null)
                $otherVariants = SongVariant::query()
                    ->where('visibility', '=', 1)
                    ->where('id_song', '=', $idSong)
                    ->where('id_form_of_writing', '=', $type)
                    ->get()->toArray();
            else
            $otherVariants = SongVariant::query()
                        ->where('id_user', '=', Auth::id())
                        ->where('id_song', '=', $idSong)
                        ->where('id_form_of_writing', '=', $type)
                        ->get()->toArray();
        } else {
            $variantSong = SongVariant::query()
                ->where('id', '=', $idVariantSong)
                ->where('id_song', '=', $idSong)
                ->first();
            $otherVariants = SongVariant::query()
                ->where('id_song', '=', $idSong)
                ->where('id_form_of_writing', '=', $type)
                ->get()->toArray();
        }
        $song = $variantSong->getAttributes();
        $s = $this->Song->getAttributes();
        $artist = Artist::query()
            ->where('id', '=', $s['id_artist'])
            ->first();
        $s['id_artist'] = $artist->name;
        if (!empty($otherVariants)) {
            $song['otherVariant'] = $otherVariants;
        }
        $song['id_song'] = $s;
        return $song;
    }

    public function getAllSongsFrom($page = 0){
        $songs = DB::table('songs')
            ->join('artist', 'artist.id', '=', 'songs.id_artist' )
            ->select('songs.id','songs.name', 'artist.name as artist', 'songs.id_artist')
            ->orderBy('id', 'desc')
            ->skip($page * 10)
            ->take( 10)
            ->get()->toArray();
        $songsValue = array();
        foreach ($songs as $song){
            $temp = SongVariant::query()
                ->where('visibility', '=', true)
                ->where('id_song', '=', $song->id)->get()->toArray();
            if (!empty($temp)) {
                $songsValue[] = $song;
            }
        }
        return $songsValue;
    }

    public function getMyAddedSong($page=0){
        return SongVariant::query()
            ->join('songs', 'songs.id', '=', 'song_variant.id_song')
            ->join('artist', 'artist.id', '=', 'songs.id_artist')
            ->join('form_of_writing', 'form_of_writing.id', '=', 'song_variant.id_form_of_writing')
            ->orderBy('songs.id', 'desc')
            ->where('song_variant.id_user', '=', Auth::id())
            ->skip($page * 10)
            ->take( 10)
            ->get(['songs.id as id', 'artist.name as nameArtist', 'artist.id as artistId', 'song_variant.id as song_variantId', 'songs.name as name', 'form_of_writing.name as form_of_writing', 'form_of_writing.id as form_of_writingId' ])
            ->toArray();
    }

    public function getSearchSongsFrom($search): array
    {
        $songs = DB::table('songs')
            ->join('artist', 'artist.id', '=', 'songs.id_artist' )
            ->select('songs.id','songs.name', 'artist.name as artist', 'songs.id_artist')
            ->where('name', 'like', $search)->get()->toArray();
        $songsValue = array();
        foreach ($songs as $song){
            $temp = SongVariant::query()
                ->where('visibility', '=', true)
                ->where('id_song', '=', $song->id)->get()->toArray();
            if (!empty($temp)) {
                $songsValue[] = $song;
            }
        }
        return $songsValue;
    }

    public function getArtistSongs($id)
    {
        $songs = DB::table('songs')
            ->join('artist', 'artist.id', '=', 'songs.id_artist' )
            ->select('songs.id','songs.name', 'artist.name as artist', 'songs.id_artist')
            ->where('songs.id_artist', 'like', $id)->get()->toArray();
        $songsValue = array();
        foreach ($songs as $song){
            $temp = SongVariant::query()
                ->where('visibility', '=', true)
                ->where('id_song', '=', $song->id)->get()->toArray();
            if (!empty($temp)) {
                $songsValue[] = $song;
            }
        }
        return $songsValue;
    }
}
