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
            ->where('id_song', '=', $id)
            ->where('id_form_of_writing', '=', $type)
            ->where('visibility', '=', true)
            ->orWhere(function($query) use ($type, $id) {
                $query->where('id_song', '=', $id)
                    ->where('id_form_of_writing', '=', $type)
                    ->where('visibility', '=', false)
                    ->where('id_user', '=', Auth::id());
            })
            ->get();
        if(!$SV->isEmpty()){
            return $SV->toArray();
        }
    }

    public function getOpenVariantById($id){
        $SV = SongVariant::query()
            ->where('id', '=', $id)
            ->where('visibility', '=', true)
            ->orWhere(function($query) use ($id) {
                $query->where('id', '=', $id)
                    ->where('visibility', '=', false)
                    ->where('id_user', '=', Auth::id());
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
}
