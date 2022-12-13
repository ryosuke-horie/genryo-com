<?php

namespace Tests\Feature;

use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\TransactionStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Weight;
use App\Models\User;


class WeigtControllerTest extends TestCase
{
    // use RefleshDatabase;
    // テスト前にseederを実行する。
    protected $seed = true;

    /** @test */
    public function 体重TOPのURLにアクセスして画面が表示される()
    {
        // DatabaseSeederを実行
        $this->seed();
        $this->withoutExceptionHandling();

        $response = $this->actingAs(User::find(1))
        ->get('/weight')
        ->assertStatus(200);    
    }
}
