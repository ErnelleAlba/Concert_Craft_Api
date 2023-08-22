<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConcertStoreRequest;
use App\Http\Requests\ConcertUpdateRequest;
use App\Http\Resources\ConcertResource;
use App\Models\Booking;
use App\Models\Concert;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Concert::query();

        if ($request->month) {
            $query->whereMonth('event_date', $request->month);
        }

        if ($request->title) {
            $query->where('title', 'LIKE', '%' .  $request->title . '%');
        }

        return ConcertResource::collection($query->orderBy('event_date')->get());
        // return ConcertResource::collection(Concert::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConcertStoreRequest $request)
    {
        $recipe = Concert::create([
            'title' => $request->title,
            'poster_image_url' => $request->posterImageUrl,
            'description' => $request->description,
            'event_date' => $request->eventDate,
            'event_place' => $request->eventPlace,
            'ticket_price' => $request->ticketPrice,
        ]);

        if ($request->hasFile('posterImageUrl')) {
            $file = $request->file('posterImageUrl');

            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storePubliclyAs('public/concerts', $fileName);

            $recipe->poster_image_url = 'storage/concerts/' . $fileName;
            $recipe->save();
        }

        return ConcertResource::make($recipe);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $concert = Concert::find($id);
        return ConcertResource::make($concert);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConcertUpdateRequest $request, $id)
    {
        $concert = Concert::find($id);

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
    public function destroy($id)
    {
        $concert = Concert::find($id);

        try {
            Booking::where('concert_id', $concert->id)->delete();
            $concert->delete();

            return response()->json([
                'success' => true,
                'message' => 'This concert has been deleted',
            ]);

        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete concert',
            ]);
        }
    }
}
