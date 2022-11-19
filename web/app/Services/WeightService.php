<?php

namespace App\Services;

use App\Repositories\WeightRepositoryInterface;

class WeightService implements WeightServiceInterface
{
    private $weight_repository;

    public function __construct(WeightRepositoryInterface $weight_repository)
    {
        $this->weight_repository = $weight_repository;
    }

    public function getWeightLog($target_days)
    {
        // 1週間分の体重のデータを取得。
        $weight_log = [];
        foreach ($target_days as $date_key) {
            $log = $this->weight_repository->getWeightLogData($date_key);
            $weight_log[] = $log;
        }

        return $weight_log;
    }
}
