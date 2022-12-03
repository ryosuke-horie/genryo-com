<?php

namespace App\Repositories;

interface WeightRepositoryInterface
{
    public function getWeightLogPerPeriod($userId, $period);
    public function getWeightLogById($userId);
    public function getWeightDataById($id);
    public function update_weight_log($weight_datas);
}