<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'description',
        'user_id',
        'client_id',
        'deadline',
        'status',
    ];

    public const STATUS = ['in_progress', 'completed', 'open'];
}
