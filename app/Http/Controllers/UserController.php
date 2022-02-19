<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate name
        $request->validate([
            'name' => 'string',
        ]);

        $user = User::find($id);

        $user->name = $request->name;

        $user->save();

        return response($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        //validate email and password fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //get user record
        $user = User::where('email', $request->email)->first();

        //invalid login handle
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'The provided credentials are incorrect.',
            ], 404);
        }

        //generate token
        $token = $user->createToken('my-auth-token')->plainTextToken;

        //send user information and token as response
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 200);
    }

    public function register(Request $request)
    {
        //validate email and password fields
        $request->validate([
            'name' => 'string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response($user, 200);
    }
}