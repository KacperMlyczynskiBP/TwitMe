<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
      'user_id',
      'body',
      'image_path',
      'reply_id',
    ];

    public function likeable(){
        return $this->belongsToMany('App\Models\User', 'likes');
    }

    public function replies(){
        return $this->belongsToMany('App\Models\Reply', 'Replies');
    }

}
