<?php

namespace Tests\Unit;

use App\Helpers\CheckIfUserIsBlockedHelper;
use App\Models\Blocked;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizeUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_authorize()
    {
        $helper = new CheckIfUserIsBlockedHelper();
        $user = User::factory()->create();
        $this->actingAs($user);


        // Test when user is not blocked
        $this->assertTrue($helper->authorizeUser($user->id));

        $blockedUser = User::factory()->create();
        $blocked = Blocked::create(['user_id'=>$user->id, 'blocked_user_id'=>$blockedUser->id]);

        //test when user is not authorized returns false
        $this->actingAs($blockedUser);
        $this->assertFalse($helper->authorizeUser($user->id));

        //test when user is not authorized returns false
        $this->actingAs($user);
        $this->assertFalse($helper->authorizeUser($blockedUser->id));
    }
}
