<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable=[
        'people_number', 'availability'
    ];

    use HasFactory;

    public function reservations(){
        return $this->hasMany('App\Models\Table');
    }
}
