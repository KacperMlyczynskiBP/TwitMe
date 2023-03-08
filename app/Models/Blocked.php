<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blocked extends Model
{

    protected $table = 'blocked_users';

    protected $fillable = [
      'user_id', 'blocked_user_id',
      'created_at', 'updated_at	'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
