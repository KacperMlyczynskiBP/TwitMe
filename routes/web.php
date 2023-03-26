<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\{NotificationController, BlockUserController, BookmarkController, ExploreController, StripeController,
    VerificateNumberController, PostController, MessageController, ProfileController, Controller, UserController};

Auth::routes(['verify' => true]);

Route::prefix('google')->group(function () {
    Route::controller(GoogleController::class)->group(function () {
        Route::get('/redirect', 'redirect')->name('redirect.google');
        Route::get('/callback', 'handleCallback');
        Route::post('/register', 'registerGoogleUser')->name('register.google.user');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/', [Controller::class, 'createPage'])->name('index');
    Route::post('/search', [Controller::class, 'search'])->name('search');

    Route::controller(UserController::class)->group(function () {
        Route::post('/follow', 'follow')->name('follow.user');
    });

    Route::get('/blockUser/{user}', [BlockUserController::class, 'blockUser'])->name('block.user');

    Route::prefix('notifications')->group(function () {
        Route::controller(NotificationController::class)->group(function () {
            Route::get('/', 'notifications')->name('show.notifications');
            Route::get('/verified', 'notificationsVerified')->name('show.notifications.verified');
            Route::get('/mentions', 'notificationsMentions')->name('show.notifications.mentions');
        });
    });

    Route::prefix('bookmarks')->group(function () {
        Route::controller(BookmarkController::class)->group(function () {
            Route::get('/', 'bookmarks')->name('show.bookmarks');
            Route::get('/save/{post}', 'saveBookmark')->name('save.bookmark');
        });
    });

    Route::get('/explore', [ExploreController::class, 'explore'])->name('show.explore');

    Route::prefix('messages')->group(function () {
        Route::controller(MessageController::class)->group(function () {
            Route::get('/', 'index')->name('create.messages');
            Route::get('/search/user', 'createSearchPage')->name('create.search.users');
            Route::post('/search', 'search')->name('search.user');
            Route::post('/store', 'store')->name('store.message');
            Route::get('/{user}/chat', 'createChat')->name('create.chat');
        });
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('/singleTweet/{post}', 'show')->name('show.single');
        Route::get('/likeTweet/{post}/{userId}', 'likeTweet')->name('like.tweet');
        Route::get('/list/posts/likes{post}', 'listPostLikes')->name('list.posts.likes');
        Route::post('/retweet/{post}', 'retweet')->name('retweet');
        Route::post('/tweet', 'storeTweet')->name('store.tweet');
        Route::post('/tweet/reply', 'storeTweetReply')->name('store.tweet.reply');
        Route::delete('/delete/{post}', 'softDelete')->name('undo')->middleware('subscription');
    });

    Route::prefix('profile')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/followers/{id}', 'createProfileFollowers')->name('create.profile.followers');
            Route::get('/following/{id}', 'createProfileFollowing')->name('create.profile.following');
            Route::get('/tweets/{id}', 'createProfileTweets')->name('create.profile.tweets');
            Route::get('/likes/{id}', 'createProfileLikes')->name('create.profile.likes');
            Route::get('/media/{id}', 'createProfileMedia')->name('create.profile.media');
            Route::get('/{id}', 'createProfile')->name('create.profile');
            Route::get('/tweetsReplies/{id}', 'createProfileTweetsReplies')->name('create.profile.replies');
            Route::post('/update/user', 'updateUser')->name('update.user');
            Route::get('/edit/{id}', 'createProfileEdit')->name('create.profile.edit');
            Route::get('/delete/profile/picture', 'deletePicture')->name('delete.picture');
        });
    });

    Route::prefix('verification')->group(function () {

        Route::get('/features', [Controller::class, 'verificationFeatures'])->name('show.verification.features');

        Route::middleware('subscription')->group(function () {
            Route::controller(VerificateNumberController::class)->group(function () {
                Route::post('/send/sms', 'sendSMSverification')->name('send.sms.verification');
                Route::get('/code', 'enterVerificationCode')->name('enter.verification.code');
                Route::get('/phone/number', 'verificateNumber')->name('show.number.verification');
                Route::post('/phone/number/check', 'verificatePhoneNumber')->name('verificate.number');

                Route::middleware('is.phone.verified')->group(function () {
                    Route::get('/', 'verification')->name('show.verification');
                });
            });
        });
    });

    Route::post('/payment', [StripeController::class, 'handlePayment'])->name('handle.payment');
});
