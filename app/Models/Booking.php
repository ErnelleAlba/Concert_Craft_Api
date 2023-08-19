<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable =[
        'customer_id',
        'concert_id',
        'seat_position',
        'no_of_tickets',
        'total_price',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function concert(){
        return $this->belongsTo(Concert::class);
    }
}
