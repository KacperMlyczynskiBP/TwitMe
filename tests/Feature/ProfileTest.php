<?php

namespace Tests\Feature;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProfile()
    {
        $user=User::factory()->create();
        $posts=Post::factory(5)->create(['user_id'=>$user->id]);

        $this->actingAs($user);

        $response=$this->get(route('create.profile', ['id'=>$user->id]));
        $response->assertSuccessful();

        $response->assertViewIs('profile.profileImproved');
        $response->assertViewHasAll(['user', 'userTweets']);
    }


    public function testProfileTweets(){
        $user=User::factory()->create();
        $posts=Post::factory(5)->create(['user_id'=>$user->id]);

        $this->actingAs($user);

        $response=$this->get(route('create.profileTweets', ['id'=>$user->id]));
        $response->assertSuccessful();

        $response->assertViewIs('profile.profileImproved');
        $response->assertViewHasAll(['user', 'userTweets']);
    }

    public function testProfileLikes(){
        $user=User::factory()->create();
        $likes=Post::factory(5)->create();
        $this->actingAs($user);
    }


    }
