<?php

namespace App\Repository;

use App\Models\Artist;
use App\Models\Genre;
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
}
