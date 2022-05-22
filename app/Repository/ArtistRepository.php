<?php

namespace App\Repository;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $artist;

    public function __constructor(Artist $model){
        $this->artist=$model;
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

    public function getAll(){
        return Artist::all();
    }
}
