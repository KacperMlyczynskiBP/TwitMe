<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcation extends Model
{
    protected $fillable=[
        'status','income','job'
    ];

    use HasFactory;
}
