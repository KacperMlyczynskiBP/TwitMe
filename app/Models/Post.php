<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
      'user_id',
      'body',
      'image_path',
      'reply_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likeable(){
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
    }

    public function viewCount(){
        return $this->hasOne(TweetView::class, 'tweet_id');
    }
}
