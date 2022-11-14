<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $table = 'weight';
    protected $fillable = ['id', 'userId', 'weight', 'date_key'];
    
    /**
     * 体重データをchart.js用に取得する
     *
     * @param [type] $date_key YYYYmmdd形式で日付を渡す。
     * @return void
     */
    public function getWeightLogData($date_key)
    {
        $sum = 0;
        $min = 0;
        $max = 100;
        $logs = Weight::where("date_key", "like", $date_key . "%")->get();

        foreach ($logs as $log) {
            $weight = $log->weight;
            $sum += $weight;
            $min = max($min, $weight);
            $max = min($max, $weight);
        }

        $avg = ($logs->count() > 0) ? $sum / $logs->count() : 0;

        return [
            $avg,
            $min,
            $max
        ];
    }
}
