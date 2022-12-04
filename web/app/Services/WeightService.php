<?php

namespace App\Services;

use App\Repositories\WeightRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WeightService implements WeightServiceInterface
{
    private $weight_repository;

    public function __construct(WeightRepositoryInterface $weight_repository)
    {
        $this->weight_repository = $weight_repository;
    }

    /**
     * 1週間前からのすべての体重データを取得する。
     * @param mixed $userId
     * @return array
     */
    public function getWeekWeightLog($userId) {
        $subWeek   = Carbon::now()->subWeek();
        $weightLog = $this->weight_repository->getWeightLogPerPeriod($userId ,$subWeek);

        if(empty($weightLog)) {
            return [];
        }

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

    public function store($request){
        $request = $request->toArray();
        $store_data = [];
        $store_data['userId'] = Auth::id();
        $store_data['weight'] = $request['weight'];

        $this->weight_repository->storeWeightLog($store_data);
    }

    public function update($request){
        $weight_datas = $request->toArray();

        // 体重記録時間を調整し、配列を更新する
        $replaced_momoried_at = str_replace('T', ' ', $weight_datas['memoried_at']);
        $replaced_momoried_at = $replaced_momoried_at . ':00';
        $weight_datas['memoried_at'] = $replaced_momoried_at;

        $this->weight_repository->update_weight_log($weight_datas);
    }
}
