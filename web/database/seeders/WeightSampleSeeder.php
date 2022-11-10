<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Weight;

class WeightSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //開始日を６ヶ月前にする
		$start = strtotime("-6 month");
		//作成する日数（180日分）
		$days = 180;
		//初期体重(50.0kg)
		$weight = 50.0;
		for($i = 0; $i < $days; $i++){
			//作成する日
			$date = $start + $i * 24 * 60 * 60;
			//体重をランダムで作成する
			//-200g〜200gで増減するようにする
			$weight += 0.1 * (2 - rand(0, 4));
			
			//保存実行
			$log = new Weight();
			$log->date_key = date("Ymd", $date);
			$log->weight = $weight;
            $log->userId = 1;
			$log->save();
		}
    }
}
