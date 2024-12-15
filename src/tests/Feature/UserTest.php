<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use App\Models\Profile;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowUser()
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->create();
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($admin, 'admin')->get('/admin/admin');

        $response->assertStatus(200);
    }

    public function testDeleteUser()
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin, 'admin')->post('/admin/user/delete', [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
