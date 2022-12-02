<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Weight;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Services\WeightServiceInterface;
use App\Services\GameWeightServiceInterface;
use PhpParser\Node\Stmt\Label;

class WeightController extends Controller
{
    private weightServiceInterface     $weight_service;
    private gameWeightServiceInterface $game_weight_service;

    public function __construct(WeightServiceInterface $weight_service, GameWeightServiceInterface $game_weight_service)
    {
        $this->weight_service = $weight_service;
        $this->game_weight_service = $game_weight_service;
    }

    /**
     * 体重管理初期ページ
     */
    public function index(Request $request)
    {
        // １週間分の体重ログデータ。
        $weihgt_logs = $this->weight_service->getWeekWeightLog(Auth::id());

        // グラフ用に変換
        $weihgt_log = [];
        $label = [];
        foreach($weihgt_logs as $data) {
            $weihgt_log[] = $data['weight'];
            $date_label = substr($data['memoried_at'], 0, -3);
            $date_label = substr($date_label, 5);
            $label[] = $date_label;
        }
        $weihgt_log = array_values($weihgt_log);
        $label = array_values($label);

        // 試合体重を取得
        $game_weight = $this->game_weight_service->getGameWeightByUserId(Auth::id());

        // 試合体重をグラフ用に加工
        // chart.jsで表示するために体重ログデータの数と同じ配列にする。
        $game_weight_log = [];
        for ($i = 1; $i <= count($label); $i++) {
            $game_weight_log[] = $game_weight;
        }
        
        // 軽量日
        $weight_in = $this->game_weight_service->getWeightInByUseId(Auth::id());

        // 体重入力用ダイアログのために現在時刻を取得
        $now = new Carbon('now');

        return view("weight.index", [
            "label"           => $label,
            "weight_log"      => $weihgt_log,
            "now"             => $now->format('Ymd'),
            "game_weight"     => $game_weight,
            "weight_in"       => $weight_in,
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
