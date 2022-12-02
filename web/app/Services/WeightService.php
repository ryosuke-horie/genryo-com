<?php

namespace App\Services;

use App\Repositories\WeightRepositoryInterface;
use Carbon\Carbon;

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

    public function getWeekWeightLog($userId) {
        $subWeek = Carbon::now()->subWeek();
        $weightLog = $this->weight_repository->getWeightLogPerPeriod($userId ,$subWeek);
        $weightLog = $weightLog->toArray();
        return $weightLog;
    }

    /**
     * リスト表示でデータを取得
     * デフォルトでは全件
     * あとからページャー
     * あとから検索
     */
    public function weightLogList($userId)
    {
        $weight_log = $this->weight_repository->getWeightLogById($userId);

        if (empty($weight_log)) {
            return [];
        }

        // Changing the display format of the recording date and time(updated_at).
        foreach($weight_log as $key => $val){
            $recording_date = date('Y/m/d G:i',  strtotime($val['memoried_at']));
            $weight_log[$key]['memoried_at'] = $recording_date;
        }
 
        return $weight_log;
    }

    public function getWeightDataById($id){
        $weight_log = $this->weight_repository->getWeightDataById($id);
        
        return $weight_log;
    }

    public function update($update_requests){
        $weight_datas = $update_requests->toArray();

        // 体重記録時間を調整し、配列を更新する
        $replaced_momoried_at = str_replace('T', ' ', $weight_datas['memoried_at']);
        $replaced_momoried_at = $replaced_momoried_at . ':00';
        $weight_datas['memoried_at'] = $replaced_momoried_at;

        $this->weight_repository->update_weight_log($weight_datas);
    }
}
