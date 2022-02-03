<?php

namespace App\Http\Controllers;

use App\Models\Vandor;
use Illuminate\Http\Request;

class VandorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vandor::create([
        'username'=>$request->username,
        'email'=>$request->email,
         'password'=>$request->password,
        'name'=>$request->name,
        'store_name'=>$request->store_name,
        'address_two'=>$request->address_tow,
        'address_one'=>$request->address_one,
        'country'=>$request->country,
        'city'=>$request->city,
        'state'=>$request->state,
        'zipecode'=>$request->zipecode,
        'store_phone'=>$request->store_phone,
       
           ]);
           $message = "Vendor Added Successfully ";
           return response()->json( $message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vandor  $vandor
     * @return \Illuminate\Http\Response
     */
    public function show(Vandor $vandor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vandor  $vandor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vandor $vandor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vandor  $vandor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vandor $vandor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vandor  $vandor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vandor $vandor)
    {
        
    }
}
