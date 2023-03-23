<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Conversation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'conversations';

    protected $fillable = ['id'];


    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
