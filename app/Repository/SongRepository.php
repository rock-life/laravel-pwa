<?php

namespace App\Repository;

use App\Models\ArtistModel;
use App\Models\SongsModel;
use Illuminate\Http\Request;

class SongRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $Song;

    public function __constructor(SongsModel $model){
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
}
