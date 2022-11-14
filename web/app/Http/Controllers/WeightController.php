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
     * 初期ページ
     */
    public function index(Request $request) {

    $now = Carbon::now()->format('Ymd');

    $avg_weihgt_log = [];
	$max_weihgt_log = [];
	$min_weihgt_log = [];




	//取り出す対象
	$target_days = [
		"202206",
		"202207",
		"202208",
		"202209",
		"202210",
		"202211",
	];

	foreach($target_days as $date_key){
		list($avg, $max, $min) = $this->getWeightLogData($date_key);
		$avg_weihgt_log[] = $avg;
		$max_weihgt_log[] = $max;
		$min_weihgt_log[] = $min;
	}

	return view("weight.index",[
		"label" => [
			"2020年6月",
			"2020年7月",
			"2020年8月",
			"2020年9月",
			"2020年10月",
			"2020年11月",
		],
		"avg_weight_log" => $avg_weihgt_log,
		"max_weight_log" => $max_weihgt_log,
		"min_weight_log" => $min_weihgt_log,
        "now"            => $now,        
	]);
    }

    /**
     * 体重データをchart.js用に取得する
     *
     * @param [type] $date_key
     * @return void
     */
    function getWeightLogData($date_key){
        $sum = 0;
        $max = 0;
        $min = 500;
        $logs = Weight::where("date_key","like",$date_key . "%")->get();
    
        foreach($logs as $log){
            $weight = $log->weight;
            $sum += $weight;
            $max = max($max, $weight);
            $min = min($min, $weight);
        }
    
        $avg = ($logs->count() > 0) ? $sum / $logs->count() : 0;
    
        return [
            $avg,
            $max,
            $min
        ];
    }

    /**
     * 表示ページ
     */
    public function show() {
        return view('weight.show');
    }

    /**
     * 入力ページ
     */
    public function input() {
        $now = Carbon::now()->format('Ymd');
        return view('weight.input',compact('now'));
    }

    /**
     * 体重登録機能
     * @param Request $request
     * @return void
     */
    public function memoryWeight(Request $request) {
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
    public function edit(Request $request) {
        return view('weight.edit');
    }

    /**
     * 削除ページ
     */
    public function delete(Request $request) {
        return view('weight.delete');
    }
}
