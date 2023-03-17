<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retweet extends Model
{
    use HasFactory;

    protected $table = 'retweets';

    protected $fillable = ['comment', 'user_id', 'post_id'];
}
