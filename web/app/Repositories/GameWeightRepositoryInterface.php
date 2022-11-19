<?php

namespace App\Repositories;

use http\Env\Request;

interface GameWeightRepositoryInterface
{
    public function getGameWeightByUserId($userId);

    public function getWeightInByUserId($userId);

    public function store($userId, $request);
}
