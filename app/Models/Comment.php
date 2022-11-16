<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable=[
        'body',
        'post_id',
        'user_id',
        'reply_id'
    ];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function replies(){
        return $this->hasMany('App\Models\Comment', 'reply_id', 'id');
    }
}

