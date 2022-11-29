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


    /**
     * 引数に渡した日付の体重のデータを取得
     * 
     * @param [type] $target_days
     * @return array $weight_log
     */
     public function getWeightLog($target_days)
    {
        $weight_log = [];
        foreach ($target_days as $date_key) {
            $log = $this->weight_repository->getWeightLogData($date_key);
            $weight_log[] = $log;
        }

        return $weight_log;
    }

    /**
     * リスト表示でデータを取得
     * デフォルトでは全件
     * あとからページャー
     * あとから検索
     */
    public function weightLogList($userId)
    {
        $weight_log = [];
        $weight_log = $this->weight_repository->getWeightLogById($userId);
 
        return $weight_log;
    }
}
