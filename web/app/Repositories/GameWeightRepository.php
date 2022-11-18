<?php

namespace App\Repositories;

use App\Models\GameWeight;

class GameWeightRepository implements GameWeightRepositoryInterface
{
    public function getSampleById($id)
    {
        return GameWeight::find($id);
    }
}
