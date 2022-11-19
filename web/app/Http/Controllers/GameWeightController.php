<?php

namespace App\Http\Controllers;

use App\Models\GameWeight;
use App\Services\GameWeightServiceInterface;
use Illuminate\Http\Request;
use Auth;


class GameWeightController extends Controller
{
    private gameWeightServiceInterface $game_weight_service;

    public function __construct(GameWeightServiceInterface $game_weight_service)
    {
        $this->game_weight_service = $game_weight_service;
    }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 登録
        $this->game_weight_service->store(Auth::id(), $request);

        // 登録後は体重のインデックスページに遷移。
        return redirect('/weight');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\GameWeight $gameWeight
     * @return \Illuminate\Http\Response
     */
    public function show(GameWeight $gameWeight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\GameWeight $gameWeight
     * @return \Illuminate\Http\Response
     */
    public function edit(GameWeight $gameWeight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\GameWeight $gameWeight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameWeight $gameWeight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\GameWeight $gameWeight
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameWeight $gameWeight)
    {
        //
    }
}
