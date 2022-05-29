<?php

namespace App\Repository;

use App\Models\Artist;
use App\Models\SavedSong;
use App\Models\SongVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongVariantRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $songVariant;

    public function __constructor(SongVariant $model){
        $this->songVariant=$model;
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

    public function getOpenVariantByIdType($id, $type){
        $SV = SongVariant::query()
            ->join('users' , 'users.id', '=', 'song_variant.id_user', 'left')
            ->where('id_song', '=', $id)
            ->where('id_form_of_writing', '=', $type)
            ->get(['song_variant.visibility as visibility', 'song_variant.id as id', 'song_variant.id_user as id_user', 'users.id_role as id_role'])->toArray();

        return $SV;
    }

    public function getOpenVariantById($id){
        $SV = SongVariant::query()
            ->join('saved_song', 'saved_song.id_user', '=',  Auth::id(), 'left', 'saved_song.id_song = song_variant.id')
            ->where('id', '=', $id)
            ->orWhere(function($query) use ($id) {
                $query->where('id', '=', $id)
                    ->where('visibility', '=', false)
                    ->where('song_variant.id_user', '=', Auth::id());
            })
            ->first();
        return $SV->getAttributes();
    }

    public function delMyAddedSong($id){
        SavedSong::query()
            ->where('id_song', '=', $id)
            ->delete();
       return SongVariant::query()
            ->where('id', '=', $id)
            ->delete();
    }

    public function editSong($data)
    {
        SongVariant::query()->where('id', '=', $data->get('id'))->update([
            'text'=> $data->get('text-edit-song'),
            'visibility' => false,
            'video_of_song' => $data->get('url_song'),
            'video_lesson' => $data->get('url_lesson'),
            'id_form_of_writing' => $data->get('type')
        ]);
        $songVariant = SongVariant::query()->where('id', '=', $data->get('id'))->get()->toArray();
        return $songVariant[0];
    }

    public function getSongVariant($id)
    {
        return SongVariant::query()
            ->join('songs', 'songs.id', 'song_variant.id_song')
            ->join('artist', 'artist.id', 'songs.id_artist')
            ->join('form_of_writing', 'song_variant.id_form_of_writing', 'form_of_writing.id')
            ->where('song_variant.id', '=', $id)
            ->get(['song_variant.id','songs.name as name','artist.name as artist', 'text', 'video_of_song', 'video_lesson', 'form_of_writing.name as form_of_writing'])
            ->toArray();
    }

    public function editSongVisibility($get)
    {
        $v = SongVariant::query()->where('id', '=', $get)->get(['visibility'])->toArray()[0]['visibility'];
        if ($v == true)
            $v = false;
        else
            $v = true;
        SongVariant::query()->where('id', '=', $get)->update([
            'visibility' => $v
        ]);

    }

    public function getModSongs($page = 0){
        return SongVariant::query()
            ->join('songs', 'songs.id', 'song_variant.id_song')
            ->join('artist', 'artist.id', 'songs.id_artist')
            ->join('form_of_writing', 'song_variant.id_form_of_writing', 'form_of_writing.id')
            ->orderBy('song_variant.id', 'desc')
            ->skip($page * 10)
            ->take( 10)
            ->get(['songs.id as id','song_variant.id as variantId','songs.name as name','artist.name as artist','artist.id as artistId','form_of_writing.name as form_of_writing' , 'form_of_writing.id as form_of_writingId' , 'song_variant.visibility'])
            ->toArray();
    }

    public function canEdit($get)
    {
        $id = SongVariant::query()->where('id', '=', $get)->get(['id_user as id'])->toArray()[0]['id'];
        if ($id == Auth::id() || Auth::user()->id_role > 1)
            return true;
        else
            return false;
    }
}
