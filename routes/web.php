<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, Controller, TweetController, ProfileController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes(['verify' => true]);
Auth::routes();

Route::get('google/redirect', [\App\Http\Controllers\Auth\GoogleController::class, 'redirect'])->name('redirect.google');
Route::get('google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleCallback']);

Route::middleware('auth')->group(function(){
    Route::get('/', [Controller::class, 'createPage'])->name('index');

    Route::post('/search', [Controller::class, 'search'])->name('search');

    Route::prefix('profile')->group(function (){
        Route::controller(ProfileController::class)->group(function(){
            Route::get('/tweets', 'createProfileTweets')->name('create.profileTweets');
            Route::get('/likes', 'createProfileLikes')->name('create.profileLikes');
            Route::get('/{username}', 'createProfile')->name('create.profile');
            Route::get('/tweetsReplies',  'createProfileTweetsReplies')->name('create.profileReplies');
        });
    });

    Route::controller(UserController::class)->group(function(){
        Route::post('/follow', 'follow')->name('follow.user');
    });

    Route::controller(TweetController::class)->group(function(){
        Route::get('/singleTweet/{postId}', 'show')->name('show.single');
        Route::get('/likeTweet/{postId}', 'likeTweet')->name('like.tweet');
        Route::post('/tweet', 'storeTweet')->name('store.tweet');
        Route::post('/tweet/reply','storeTweetReply')->name('store.tweet.reply');
    });
});
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('/tweetPage', [Controller::class, 'createTweetPage'])->name('create.tweetPage');
/// things to do: add login DONEE by google // add email DONEE confrimation// add messages on twitter with pagination // make search engine DONEE working//
/// make tests // two languages // learn to do endpoint // style whole page//




