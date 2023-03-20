<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = ['type','from_verified', 'is_mentioned', 'receiver_id', 'sender_id', 'comment'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


}
