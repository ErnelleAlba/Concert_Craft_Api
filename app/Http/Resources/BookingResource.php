<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "customerId" => $this->customer_id,
            "concertId" => $this->concert_id,
            "seatPosition" => $this->seat_position,
            "noOfTickets" => $this->no_of_tickets,
            "totalPrice" => $this->total_price,
        ];
    }
}
