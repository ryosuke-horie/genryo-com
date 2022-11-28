<?php

namespace App\Services;

interface GameWeightServiceInterface
{
    public function getGameWeightByUserIdForWeek($userId);
    public function getGameWeightByUserId($userId);

    public function getWeightInByUseId($userId);

    public function store($userId, $request);
}
