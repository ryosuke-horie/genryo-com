<?php

namespace App\Repositories;

use App\Models\Weight;
use PhpParser\Node\Expr\FuncCall;

class WeightRepository implements WeightRepositoryInterface
{
    /**
     * 引数に渡した日時から現在までの体重データを取得する。
     * @param int    $userId
     * @param string $period (timestampに合わせること)
     * @return array
     */
    public function getWeightLogPerPeriod($userId, $period){
        $logs = Weight::where('userId', $userId)
            ->where('memoried_at', '>=', $period)
            ->get();

        return $logs;
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

    /**
     * 体重ログ登録
     *
     * @param [type] $weight_datas
     * @return void
     */
    public function storeWeightLog($weight_datas){
        $weight = new Weight();
        $weight->userId = $weight_datas['userId'];
        $weight->weight = $weight_datas['weight'];

        $weight->save();
    }

    /**
     * 体重ログ更新処理
     * 
     * @param mixed $weight_datas
     * @return void
     */
    public function update_weight_log($weight_datas){
        $weight = Weight::find($weight_datas['id']);
        $weight->weight      = $weight_datas['weight'];
        $weight->memoried_at = $weight_datas['memoried_at'];

        $weight->save();
    }
}
