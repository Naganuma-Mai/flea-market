<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HelloTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHello()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/no_route');
        $response->assertStatus(404);

        User::factory()->create([
            'email'=>'bbb@ccc.com',
            'password'=>'test12345'
        ]);
        $this->assertDatabaseHas('users',[
            'email'=>'bbb@ccc.com',
            'password'=>'test12345'
        ]);
    }
}
