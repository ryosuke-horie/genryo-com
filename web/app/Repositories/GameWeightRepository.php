<?php

namespace App\Repositories;

use App\Models\GameWeight;
use App\Models\Weight;

class GameWeightRepository implements GameWeightRepositoryInterface
{
    /**
     * 試合体重をログインしたユーザーIDから取得する
     * @param $userId
     * @return mixed
     */
    public function getGameWeightByUserId($userId)
    {
        $gameWeight = GameWeight::select('game_weight')->where('user_id', $userId)->first();
        if(empty($gameWeight)) {
            $gameWeight = '';
        }
        return $gameWeight;
    }

    /**
     * 試合体重をログインしたユーザーIDから取得する
     * @param $userId
     * @return string
     */
    public function getWeightInByUserId($userId)
    {
        $weight_in = GameWeight::select('weight_in')->where('user_id', $userId)->first();
        
        if(empty($weight_in)){
            return '';
        }

        $weight_in = $weight_in->toArray();
        $weight_in = $weight_in['weight_in'];

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
        GameWeight::create([
            'user_id' => $userId,
            'game_weight' => $request['game_weight'],
            'weight_in' => $request['weight_in']
        ]);
    }
}
