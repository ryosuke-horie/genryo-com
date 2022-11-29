<?php

namespace App\Repositories;

use App\Models\Weight;

class WeightRepository implements WeightRepositoryInterface
{
    /**
     * 日時を受け取り、その日の体重データを受け取る。
     * @param $date_key
     * @return int
     */
    public function getWeightLogData($date_key)
    {
        $weight = 0;
        $logs = Weight::where("date_key", "like", $date_key . "%")->get();

        foreach ($logs as $log) {
            $weight = $log->weight;
        }

        return $weight;
    }

    /**
     * ユーザーIDをもとに体重のログデータを取得する。
     *
     * @param [type] $userId
     * @return array
     */
    public function getWeightLogById($userId)
    {
        $weight_log = Weight::select('id', 'weight', 'updated_at')->where("userId", "=", $userId)->get();

        if(!empty($weight_log)) {
            $weiht_log_array = $weight_log->toArray();
        } else {
            $weiht_log_array = [];
        }

        return $weiht_log_array;
    }
}
