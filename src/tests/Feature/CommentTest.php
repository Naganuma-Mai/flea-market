<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowComment()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response =  $this->actingAs($user)->get("/comment/$item->id");

        $response->assertStatus(200);
    }

    public function testStoreComment()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response = $this->actingAs($user)->post("/comment/$item->id", [
            'content' => '着心地がとてもいいです！',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'content' => '着心地がとてもいいです！',
        ]);
    }
}
