<?php

namespace Tests\Feature;

use App\Helpers\CheckIfUserIsBlockedHelper;
use App\Models\Blocked;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_authorize()
    {
        $helper = new CheckIfUserIsBlockedHelper();
        $user = User::factory()->create();
        $this->actingAs($user);

        // Test when user is not blocked
        $this->assertTrue($helper->authorizeUser($user->id));

        $blockedUser = $user::factory()->create();
        Blocked::create(['user_id'=>$user->id, 'blocked_user_id'=>$blockedUser->id]);

        //test when user is not authorized returns false
        $this->actingAs($blockedUser);
        $this->assertFalse($helper->authorizeUser($user->id));

        //test when user is not authorized returns false
        $this->actingAs($user);
        $this->assertFalse($helper->authorizeUser($blockedUser->id));
    }
}
