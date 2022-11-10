<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleController extends Controller
{
    public function showServiceContaionerTest()
    {
        app()->bind('lifeCycleTest', function(){
            return 'ライフサイクルのテスト';
        });
        $test = dd(app()->make('lifeCycleTest'));
        
        // サービスコンテナなしのパターン
        $message = new Messege();
        $sample  = new Sample($message);
        $sample->run();
    
        
        // サービスコンテナなしのパターン(依存関係を解決できている)
        app()->bind('sample', Sample::class);
        $sample = app()->make('sample');
        $sample->run();

        
        // dd($test, app());
    }
}


class Sample
{
    public $message;
    
    public function __construct(Messege $message) {
        $this->message = $message;
    }
    
    public function run() {
        $this->message->send();
    }
}

class Messege
{
    public function send() {
        echo('メッセージ表示');
    }
}