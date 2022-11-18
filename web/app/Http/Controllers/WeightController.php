<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Weight;
use App\Models\GameWeight;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class WeightController extends Controller
{
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

        // 体重データ
        $Weight = new Weight();

        // 1週間分の体重のデータを取得。
        $weihgt_log = [];
        foreach ($target_days as $date_key) {
            $log = $Weight->getWeightLogData($date_key);
            $weihgt_log[] = $log;
        }

        // 試合体重の設定
        $GameWeight = new GameWeight();
        $game_weight = $GameWeight->select('game_weight')->where('user_id', Auth::id())->first();
        $weight_in = $GameWeight->select('weight_in')->where('user_id', Auth::id())->first();

        $game_weight_log = [];
        for ($i=1; $i<8; $i++) {
            $game_weight_log[] = $game_weight['game_weight']; 
        }

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
            "weight_log"  => $weihgt_log,
            "now"         => $now->format('Ymd'),
            "game_weight" => $game_weight['game_weight'],
            "weight_in"   => date('Y年m月d日',  strtotime($weight_in['weight_in'])),
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
