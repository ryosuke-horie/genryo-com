<?php

namespace App\Repositories;

use App\Models\Weight;

class WeightRepository implements WeightRepositoryInterface
{
    public function getSampleById($id)
    {
        return Weight::find($id);
    }

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
}
