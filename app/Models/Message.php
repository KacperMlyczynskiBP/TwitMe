<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
     'receiver_id',
     'sender_id',
     'text',
      'conversation_id'
    ];



    public function user(){
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

}
