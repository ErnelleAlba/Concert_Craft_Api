<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConcertStoreRequest;
use App\Http\Requests\ConcertUpdateRequest;
use App\Http\Resources\ConcertResource;
use App\Models\Concert;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ConcertResource::collection(Concert::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConcertStoreRequest $request)
    {
        return ConcertResource::make(
            Concert::create([
                'title' => $request->title,
                'poster_image_url' => $request->posterImageUrl,
                'description' => $request->description,
                'event_date' => $request->eventDate,
                'event_place' => $request->eventPlace,
                'ticket_price' => $request->ticketPrice,
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Concert $concert)
    {
        return ConcertResource::make($concert);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConcertUpdateRequest $request, Concert $concert)
    {
        if(isset($request->title)) {
            $concert->title = $request->title;
        }

        if(isset($request->posterImageUrl)) {
            $concert->poster_image_url = $request->posterImageUrl;
        }
        
        if(isset($request->description)) {
            $concert->description = $request->description;
        }

        if(isset($request->eventDate)) {
            $concert->event_date = $request->eventDate;
        }

        if(isset($request->eventPlace)) {
            $concert->event_place = $request->eventPlace;
        }

        if(isset($request->ticketPrice)) {
            $concert->ticket_price = $request->ticketPrice;
        }

        $concert->save();

        return ConcertResource::make($concert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Concert $concert)
    {
        $concert->delete();
        throw new HttpResponseException(response()->json([
            'success' => true,
            'message' => 'This concert has been deleted',
        ]));
    }
}
