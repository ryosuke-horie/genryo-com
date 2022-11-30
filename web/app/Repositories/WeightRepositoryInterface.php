<?php

namespace App\Repositories;

interface WeightRepositoryInterface
{
    public function getWeightLogData($date_key);
    public function getWeightLogById($userId);

    public function getWeightDataById($id);
}