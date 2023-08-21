<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'concert_id',
        'seat_position',
        'no_of_tickets',
        'total_price',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function concert(){
        return $this->belongsTo(Concert::class);
    }
}
