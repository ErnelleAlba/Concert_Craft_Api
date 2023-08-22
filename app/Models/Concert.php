<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'poster_image_url',
        'description',
        'event_date',
        'event_place',
        'ticket_price',
    ];

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
