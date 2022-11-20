<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Weight;
use App\Models\GameWeight;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Services\WeightServiceInterface;
use App\Services\GameWeightServiceInterface;

class WeightController extends Controller
{
    private weightServiceInterface $weight_service;
    private gameWeightServiceInterface $game_weight_service;

    public function __construct(WeightServiceInterface $weight_service, GameWeightServiceInterface $game_weight_service)
    {
        $this->weight_service = $weight_service;
        $this->game_weight_service = $game_weight_service;
    }

    /**
     * 体重管理の初期ページ
     */
    public function index(Request $request)
    {
        // １週間分の日付を取得。
        $now   = new Carbon('now');
        $one   = new Carbon('-1 day');
        $two   = new Carbon('-2 day');
        $three = new Carbon('-3 day');
        $four  = new Carbon('-4 day');
        $five  = new Carbon('-5 day');
        $six   = new Carbon('-6 day');

        // 取り出す対象日時
        $target_days = [
            $six->format('Ymd'),
            $five->format('Ymd'),
            $four->format('Ymd'),
            $three->format('Ymd'),
            $two->format('Ymd'),
            $one->format('Ymd'),
            $now->format('Ymd'),
        ];

        // １週間分の体重ログデータ。
        $weihgt_log = $this->weight_service->getWeightLog($target_days);
        // 試合体重
        $game_weight_log = $this->game_weight_service->getGameWeightByUserIdForWeek(Auth::id());
        // 軽量日
        $weight_in = $this->game_weight_service->getWeightInByUseId(Auth::id());

        return view("weight.index", [
            "label" => [
                $six->format('m月d日'),
                $five->format('m月d日'),
                $four->format('m月d日'),
                $three->format('m月d日'),
                $two->format('m月d日'),
                $one->format('m月d日'),
                $now->format('m月d日'),
            ],
            "weight_log"      => $weihgt_log,
            "now"             => $now->format('Ymd'),
            "game_weight"     => $game_weight_log[0],
            "weight_in"       => date('Y年m月d日', strtotime($weight_in['weight_in'])),
            "game_weight_log" => $game_weight_log,
        ]);
    }

    /**
     * 表示ページ
     */
    public function show()
    {
        return view('weight.show');
    }

    /**
     * 入力ページ
     */
    public function input()
    {
        $now = Carbon::now()->format('Ymd');
        return view('weight.input', compact('now'));
    }

    /**
     * 体重登録機能
     * @param Request $request
     * @return void
     */
    public function memoryWeight(Request $request)
    {
        // 登録機能
        $weight = new Weight();
        $weight->create([
            'userId' => Auth::id(),
            'weight' => $request['weight'],
            'date_key' => $request['date_key']
        ]);

        return redirect('/weight');
    }

    /**
     * 編集ページ
     */
    public function edit(Request $request)
    {
        return view('weight.edit');
    }

    /**
     * 削除ページ
     */
    public function delete(Request $request)
    {
        return view('weight.delete');
    }
}
