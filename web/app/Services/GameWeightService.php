<?php

namespace App\Services;

use App\Models\GameWeight;
use App\Repositories\GameWeightRepositoryInterface;

class GameWeightService implements GameWeightServiceInterface
{
    private $game_weight_repository;

    public function __construct(GameWeightRepositoryInterface $game_weight_repository)
    {
        $this->game_weight_repository = $game_weight_repository;
    }

    /**
     * 試合体重をユーザーIDをもとに取得
     * weight@indexのchart.jsグラフの値として使用するため、7日分の配列にして返す。
     *
     * @param $userId
     * @return array
     */
    public function getGameWeightByUserIdForWeek($userId)
    {
        // 試合体重の設定
        $game_weight = $this->game_weight_repository->getGameWeightByUserId($userId);

        $game_weight_log = [];

        if (!empty($game_weight)) {
            for ($i = 1; $i < 8; $i++) {
                $game_weight_log[] = $game_weight['game_weight'];
            }    
        }
        
        return $game_weight_log;
    }

        /**
     * 試合体重をユーザーIDをもとに取得
     * @param $userId
     * @return
     */
    public function getGameWeightByUserId($userId)
    {
        // 試合体重の設定
        $game_weight = $this->game_weight_repository->getGameWeightByUserId($userId);

        if (empty($game_weight)) {
            return $game_weight = '';
        }

        $game_weight = $game_weight->toArray();
        
        return $game_weight['game_weight'];
    }

    /**
     * 計量日をユーザーIDをもとに取得
     * @param $userId
     * @return mixed
     */
    public function getWeightInByUseId($userId)
    {
        $weight_in = $this->game_weight_repository->getWeightInByUserId($userId);

        if (empty($weight_in)) {
            $weight_in = '';
        } else {
            $weight_in = date('Y年m月d日', strtotime($weight_in));
        }
        return $weight_in;
    }

    /**
     * 登録
     * @param $userId
     * @param $request
     * @return void
     */
    public function store($userId, $request)
    {
        $this->game_weight_repository->store($userId, $request);
    }
}
