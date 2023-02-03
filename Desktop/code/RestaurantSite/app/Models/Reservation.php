<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable=[
        'customerName','customerEmail','reservationDate','people','table_id',
    ];

    use HasFactory;
}
