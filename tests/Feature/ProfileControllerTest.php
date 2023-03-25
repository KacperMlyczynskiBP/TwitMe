<?php

namespace Tests\Feature;

use App\Helpers\CheckIfUserIsBlockedHelper;
use App\Models\Blocked;
use App\Models\Post;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProfile(){
        $profileService = new ProfileService();
        $helper = new CheckIfUserIsBlockedHelper();

        $user=User::factory()->create();
        $userTwo=User::factory()->create();
        $blockedUser=User::factory()->create();
        $blocked=Blocked::create(['user_id'=>$user->id, 'blocked_user_id'=>$blockedUser->id]);

        //Blocked user tries to enter the profile of the user that blocked him
        $this->actingAs($blockedUser);

        $response=$this->get(route('create.profile', ['id'=>$user->id]));
        $response->assertStatus(302);

        $userLogged = $profileService->getUserById($blockedUser->id);
        $this->assertNotEmpty($userLogged);

        $this->assertFalse($helper->authorizeUser($user->id));

        //logged in user tries to enter profile of the user he blocked

        $this->actingAs($user);

        $response=$this->get(route('create.profile', ['id'=>$blockedUser->id]));
        $response->assertStatus(302);

        $userLogged = $profileService->getUserById($blockedUser->id);
        $this->assertNotEmpty($userLogged);

        $this->assertFalse($helper->authorizeUser($blockedUser->id));


        //logged in user enter his own profile test

        $this->actingAs($user);

        $response=$this->get(route('create.profile', ['id'=>$user->id]));
        $response->assertSuccessful();

        $userLogged = $profileService->getUserById($user->id);
        $this->assertNotEmpty($userLogged);

        //test return true if user is authorized
        $this->assertTrue($helper->authorizeUser($user->id));

        $posts=Post::factory(5)->create(['user_id'=>$user->id]);
        $response->assertViewIs('profile.profileImproved');
        $response->assertViewHasAll(['user', 'userTweets']);
        $response->assertStatus(200);

        //logged in user enters someone else profile test

        $this->actingAs($user);

        $response=$this->get(route('create.profile', ['id'=>$userTwo->id]));
        $response->assertSuccessful();

        $this->assertTrue($helper->authorizeUser($userTwo->id));
        $posts=Post::factory(5)->create(['user_id'=>$userTwo->id]);
        $response->assertViewIs('profile.profileImproved');
        $response->assertViewHasAll(['user', 'userTweets']);
        $response->assertStatus(200);
    }


    public function testProfileTweets(){
        $profileService = new ProfileService();
        $helper = new CheckIfUserIsBlockedHelper();

        $user=User::factory()->create();
        $posts=Post::factory(5)->create(['user_id'=>$user->id]);
        $this->actingAs($user);

        $posts = $profileService->getUserTweetsById($user->id);
        $this->assertNotEmpty($posts);

        $this->assertTrue($helper->authorizeUser($user->id));

        $response=$this->get(route('create.profileTweets', ['id'=>$user->id]));
        $response->assertSuccessful();

        $response->assertViewIs('profile.profileImproved');
        $response->assertViewHasAll(['user', 'userTweets']);
        $response->assertStatus(200);
    }

    public function testProfileLikes(){
        $user=User::factory()->create();
        $likes=Post::factory(5)->create();
        $this->actingAs($user);
    }

//    public function testProfileMedia(){
//
//    }
}
