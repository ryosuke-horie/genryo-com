<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\TransactionStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class WeigtControllerTest extends TestCase
{
    use RefreshDatabase;
    // テスト前にseederを実行する。
    // protected $seed = true;

    /** @test */
    public function 体重TOPのURLにアクセスして画面が表示される()
    {
        // DatabaseSeederを実行
        // $this->seed();
        $this->withoutExceptionHandling();

        $response = $this->actingAs(User::find(1))
        ->get('/weight')
        ->assertStatus(200);
    }

    /**
     * @test
     */
    public function 体重詳細のURLにアクセスして画面が表示される()
    {
                // DatabaseSeederを実行
                // $this->seed();
                $this->withoutExceptionHandling();
        
                $response = $this->actingAs(User::find(1))
                ->get('/weight/detail')
                ->assertStatus(200);
    }

    /**
     * @test
     */
    public function 体重編集のURLにアクセスして画面が表示される()
    {
                // DatabaseSeederを実行
                // $this->seed();
                $this->withoutExceptionHandling();
        
                $response = $this->actingAs(User::find(1))
                ->get('/weight/edit')
                ->assertStatus(200);
    }
}
