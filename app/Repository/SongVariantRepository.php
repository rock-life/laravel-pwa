<?php

namespace App\Repository;

use App\Models\ArtistModel;
use App\Models\SongVariantModel;
use Illuminate\Http\Request;

class SongVariantRepository implements \Dotenv\Repository\RepositoryInterface
{
    protected $SV;

    public function __constructor(SongVariantModel $model){
        $this->SV=$model;
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
