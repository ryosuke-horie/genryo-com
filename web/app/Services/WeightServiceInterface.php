<?php

namespace App\Services;
interface WeightServiceInterface
{
    public function getWeekWeightLog($userId);
    public function weightLogList($userId);
    public function getWeightDataById($id);
    public function update($update_requests);
}
