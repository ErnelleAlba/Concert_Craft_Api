<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookingResource::collection(Booking::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingStoreRequest $request)
    {
        return BookingResource::make(
            Booking::create([
                'customer_id' => $request->customerId,
                'concert_id' => $request->concertId,
                'seat_position' => $request->seatPosition,
                'no_of_tickets' => $request->noOfTickets,
                'total_price' => $request->totalPrice,
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return  BookingResource::make($booking);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        if(isset($request->customerId)) {
            $booking->customer_id = $request->customerId;
        }

        if(isset($request->concertId)) {
            $booking->concert_id = $request->concertId;
        }

        if(isset($request->seatPosition)) {
            $booking->seat_position = $request->seatPosition;
        }

        if(isset($request->noOfTickets)) {
            $booking->no_of_tickets = $request->noOfTickets;
        }

        if(isset($request->totalPrice)) {
            $booking->total_price = $request->totalPrice;
        }

        $booking->save();

        return BookingResource::make($booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        throw new HttpResponseException(response()->json([
            'success' => true,
            'message' => 'The booking has been deleted',
        ]));
    }
}