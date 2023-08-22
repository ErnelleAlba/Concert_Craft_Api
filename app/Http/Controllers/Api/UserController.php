<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Booking;
use App\Models\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->role) {
            $query->where('role', $request->role );
        }

        return UserResource::collection($query->get());
        // return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        return UserResource::make(
            User::create([
                "first_name" => $request->firstName,
                "last_name" => $request->lastName,
                "age" => $request->age,
                "username" => $request->username,
                "role" => $request->role,
                "email" => $request->email,
                "password" => $request->password,
                "phone" => $request->phone,
                "address" => $request->address
            ])
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return UserResource::make($user);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        if (isset($request->firstName)){
            $user->first_name = $request->firstName;
        }
        if (isset($request->lastName)){
            $user->last_name = $request->lastName;
        }
        if (isset($request->age)){
            $user->age = $request->age;
        }
        if (isset($request->username)){
            $user->username = $request->username;
        }
        if (isset($request->role)){
            $user->role = $request->role;
        }
        if (isset($request->email)){
            $user->email = $request->email;
        }
        if (isset($request->password)){
            $user->password = $request->password;
        }
        if (isset($request->phone)){
            $user->phone = $request->phone;
        }
        if (isset($request->address)){
            $user->address = $request->address;
        }

        $user->save();

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Booking::where('user_id', $id)->delete();
            $id->delete();

            return response()->json([
                'success' => true,
                'message' => 'This user has been deleted',
            ]);

        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete the user',
            ]);
        }

    }
}
