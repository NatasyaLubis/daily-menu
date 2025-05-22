<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class DailyMenuFeatureTest extends TestCase
{
    public function test_user_can_submit_menu_request_and_see_recommendation()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/daily-menu', [
            'ingredients' => ['telur', 'mie', 'sosis'],
            'budget' => 15000,
        ]);

        $response->assertStatus(200);
        $response->assertSee('Mie Rebus Sosis');
    }
}
