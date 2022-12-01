<?php

namespace App\Repositories;

use App\Models\Weight;
use PhpParser\Node\Expr\FuncCall;

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
        $weight_log = Weight::select('id', 'weight', 'memoried_at')->where("userId", "=", $userId)->orderby('memoried_at', 'desc')->get();

        if(!empty($weight_log)) {
            $weiht_log_array = $weight_log->toArray();
        } else {
            $weiht_log_array = [];
        }

        return $weiht_log_array;
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return array
     */
    public function getWeightDataById($id){
        $weight_log = Weight::where("id", "=", $id)->first();
        $weight_log = $weight_log->toArray();

        return $weight_log;
    }

    public function update_weight_log($weight_datas){
        $weight = Weight::find($weight_datas['id']);

        // 値を更新
        $weight->weight      = $weight_datas['weight'];
        $weight->memoried_at = $weight_datas['memoried_at'];

        $weight->save();
    }
}
