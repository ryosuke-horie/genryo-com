<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Weight;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Services\WeightServiceInterface;
use App\Services\GameWeightServiceInterface;

class WeightController extends Controller
{
    private weightServiceInterface     $weight_service;
    private gameWeightServiceInterface $game_weight_service;

    public function __construct(WeightServiceInterface $weight_service, GameWeightServiceInterface $game_weight_service)
    {
        $this->weight_service      = $weight_service;
        $this->game_weight_service = $game_weight_service;
    }

    /**
     * 体重管理初期ページ
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();

        // １週間分の体重ログデータ。
        $weight_logs_weekly = $this->weight_service->getWeekWeightLog($user_id);

        // 体重と記録日時をグラフ用の配列に変換
        $weihgt_log = [];
        $label      = [];
        foreach($weight_logs_weekly as $data) {
            $weihgt_log[] = $data['weight'];

            $date_label = substr($data['memoried_at'], 0, -3);
            $date_label = substr($date_label, 5);
            $label[]    = $date_label;
        }

        // 試合体重を取得
        $game_weight = $this->game_weight_service->getGameWeightByUserId($user_id);

        // 試合体重をグラフ用に加工
        // chart.jsで表示するために体重ログデータの数と同じ配列にする。
        $game_weight_graph = [];
        for ($i = 1; $i <= count($label); $i++) {
            $game_weight_graph[] = $game_weight;
        }
        
        // 軽量日
        $weight_in = $this->game_weight_service->getWeightInByUseId($user_id);

        return view("weight.index", [
            "label"             => $label,             // グラフのラベル(記録日時)
            "weight_log"        => $weihgt_log,        // 体重データ
            "game_weight"       => $game_weight,       // 試合体重
            "game_weight_graph" => $game_weight_graph, // 試合体重のグラフ用配列
            "weight_in"         => $weight_in,         // 軽量日
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
     * 詳細ページ
     */
    public function detail()
    {
        // リスト表示
        $weight_log = $this->weight_service->weightLogList(Auth::id());
        return view('weight.detail', compact('weight_log'));
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function edit(Request $request) {
        // idを指定せずに直接遷移した場合はリダイレクト
        if(empty($request->id)) {
            redirect('/weight/detail');
        }

        $weight = $this->weight_service->getWeightDataById($request->id);

        return view('weight.edit', compact('weight'));
    }


    public function update(Request $request){
        // 登録処理
        $this->weight_service->update($request);
        return redirect('/weight/detail');
    }
}
