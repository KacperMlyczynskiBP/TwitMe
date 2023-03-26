<?php

namespace Tests\Unit;

use App\Helpers\GetBlockedUsersRealtion;
use App\Models\Blocked;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class GetBlockedUsersRelationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_blocked_user_relation()
    {
        $helper = new GetBlockedUsersRealtion();

        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $otherUserTwo = User::factory()->create();

        $blockedUserOne = Blocked::create(['user_id' => $user->id, 'blocked_user_id' => $otherUser->id]);
        $blockedUserTwo = Blocked::create(['user_id' => $otherUserTwo->id, 'blocked_user_id' => $user->id]);

        $this->actingAs($user);

        $blockedUsersArray = $helper->getBlockedUserRelation($otherUser->id);
        $this->assertIsArray($blockedUsersArray);
        $this->assertEquals([$otherUser->id => $user->id], $blockedUsersArray);

        $this->assertArrayNotHasKey($otherUserTwo->id, $blockedUsersArray);
        $this->assertArrayHasKey($otherUser->id, $blockedUsersArray);


        // Ensure that no blocked users exist for the other user
//        Blocked::where('user_id', $otherUser->id)->delete();

        $this->actingAs($user);

        $blockedUsersArray = $helper->getBlockedUserRelation($otherUser->id);

        $this->assertIsArray($blockedUsersArray);
        $this->assertEmpty($blockedUsersArray);
    }
}
