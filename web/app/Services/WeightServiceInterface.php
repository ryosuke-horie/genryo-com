<?php

namespace App\Services;
interface WeightServiceInterface
{
    public function getWeightLog($target_days);
    public function getWeekWeightLog($userId);
    public function weightLogList($userId);
    public function getWeightDataById($id);
    public function update($update_requests);
}
