<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    const MIN_AGE = 13;
    const MAX_AGE = 120;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'google_id',
        'date_of_birth',
        'bio',
        'location',
        'user_image_path',
        'blue_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_user_id', 'user_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_user_id');
    }

    public function likes(){
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
    }

    public function blockedUsers()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'user_id', 'blocked_user_id')->withTimestamps();
    }

    public function blockedBy()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'blocked_user_id', 'user_id')->withTimestamps();
    }

}
