<?php

namespace App\Http\Controllers;

use App\Models\GameWeight;
use Illuminate\Http\Request;
use Auth;

class GameWeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gameWeight.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 登録機能
        $weight = new GameWeight();
        $weight->create([
            'user_id'     => Auth::id(),
            'game_weight' => $request['game_weight'],
            'weight_in'   => $request['weight_in']
        ]);

        // 登録後は体重のインデックスページに遷移。
        return redirect('/weight/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GameWeight  $gameWeight
     * @return \Illuminate\Http\Response
     */
    public function show(GameWeight $gameWeight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GameWeight  $gameWeight
     * @return \Illuminate\Http\Response
     */
    public function edit(GameWeight $gameWeight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GameWeight  $gameWeight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameWeight $gameWeight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GameWeight  $gameWeight
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameWeight $gameWeight)
    {
        //
    }
}
