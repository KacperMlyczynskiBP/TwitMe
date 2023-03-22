<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetView extends Model
{
    use HasFactory;

    protected $table = 'tweet_views';

    protected $fillable = ['tweet_id', 'views_count'];


    public function tweet(){
        return $this->belongsTo(Post::class);
    }
}
