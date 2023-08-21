<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =[
        'first_name',
        'last_name',
        'age',
        'email',
        'password',
        'phone',
        'address',
    ];

    // public function bookings(){
    //     return $this->hasMany(Booking::class);
    // }
}
