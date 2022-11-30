<?php

namespace App\Services;

interface WeightServiceInterface
{
    public function getWeightLog($target_days);
    public function weightLogList($userId);

    public function getWeightDataById($id);
}
