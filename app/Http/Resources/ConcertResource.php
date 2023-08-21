<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConcertResource extends JsonResource
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
            "title" => $this->title,
            "posterImageUrl" => $this->poster_image_url,
            "description" => $this->description,
            "eventDate" => Carbon::parse($this->event_date)->format('F d, Y-H:i A'),
            "eventPlace" => $this->event_place,
            "ticketPrice" => $this->ticket_price,
        ];
    }
}
