<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Weight;
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
        $avg_weihgt_log = [];
        $max_weihgt_log = [];
        $min_weihgt_log = [];
        foreach ($target_days as $date_key) {
            list($avg, $max, $min) = $Weight->getWeightLogData($date_key);
            $avg_weihgt_log[] = $avg;
            $max_weihgt_log[] = $max;
            $min_weihgt_log[] = $min;
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
            "avg_weight_log" => $avg_weihgt_log,
            "max_weight_log" => $max_weihgt_log,
            "min_weight_log" => $min_weihgt_log,
            "now"            => $now->format('Ymd'),
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

        return redirect('/weight/index');
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
