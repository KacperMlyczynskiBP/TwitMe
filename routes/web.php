<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, Controller, TweetController, ProfileController, Auth\GoogleController};

Auth::routes(['verify' => true]);

Route::get('google/redirect', [GoogleController::class, 'redirect'])->name('redirect.google');
Route::get('google/callback', [GoogleController::class, 'handleCallback']);
Route::post('google/register', [GoogleController::class, 'registerGoogleUser'])->name('register.google.user');

Route::middleware('auth')->group(function(){
    Route::get('/', [Controller::class, 'createPage'])->name('index');

    Route::post('/search', [Controller::class, 'search'])->name('search');

    Route::controller(TweetController::class)->group(function(){
        Route::post('/tweet', 'storeTweet')->name('store.tweet');
        Route::get('/singleTweet/{postId}', 'show')->name('show.single');
        Route::get('/likeTweet/{postId}', 'likeTweet')->name('like.tweet');
        Route::post('/tweet/reply','storeTweetReply')->name('store.tweet.reply');
    });

    Route::prefix('profile')->group(function (){
        Route::controller(ProfileController::class)->group(function(){
            Route::get('/followers/{id}', 'createProfileFollowers')->name('create.profileFollowers');
            Route::get('/following/{id}', 'createProfileFollowing')->name('create.profileFollowing');
            Route::get('/tweets/{id}', 'createProfileTweets')->name('create.profileTweets');
            Route::get('/likes/{id}', 'createProfileLikes')->name('create.profileLikes');
            Route::get('/media/{id}', 'createProfileMedia')->name('create.profileMedia');
            Route::get('/{id}', 'createProfile')->name('create.profile');
            Route::get('/tweetsReplies/{id}',  'createProfileTweetsReplies')->name('create.profileReplies');
            Route::post('/update/user', 'updateUser')->name('update.user');
            Route::get('/edit/{id}', 'createProfileEdit')->name('create.profileEdit');
            Route::get('/delete/profile/picture', 'deletePicture')->name('delete.picture');
        });
    });

    Route::controller(UserController::class)->group(function(){
        Route::post('/follow', 'follow')->name('follow.user');
    });
});






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
