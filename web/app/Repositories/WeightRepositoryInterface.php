<?php

namespace App\Repositories;

interface WeightRepositoryInterface
{
    public function getSampleById($id);
    public function getWeightLogData($date_key);
}