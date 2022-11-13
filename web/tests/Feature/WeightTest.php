<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Weight;

class WeightTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->markTestSkipped();
        $weight = new Weight;

        // $weight->firstName = 'John';
        // $weight->lastName =  'Doe';
    
        // $result = $user->getFullName();
    
        // $this->assertSame('John Doe', $result);
    }
}
