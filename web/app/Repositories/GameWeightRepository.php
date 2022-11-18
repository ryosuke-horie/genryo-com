<?php

namespace App\Repositories;

use App\Models\Weight;

class WeightRepository implements WeightRepositoryInterface
{
    public function getSampleById($id)
    {
        return Weight::find($id);
    }
}