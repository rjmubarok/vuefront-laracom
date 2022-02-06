<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VendorController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  return Vendor::all();
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
  $request->validate([
   'username'    => 'required',
   'email'       => 'required',
   'password'    => 'required',
   'store_name'  => 'required',
   'name'        => 'required',
   'store_phone' => 'required',
   'address_one' => 'required',
  ]);
  Vendor::create([
   'username'    => $request->username,
   'email'       => $request->email,
   'password'    => $request->password,
   'name'        => $request->name,
   'store_name'  => $request->store_name,
   'address_two' => $request->address_two,
   'address_one' => $request->address_one,
   'country'     => $request->country,
   'city'        => $request->city,
   'state'       => $request->state,
   'zipecode'    => $request->zipecode,
   'store_phone' => $request->store_phone,
   "created_at"  => Carbon::now(),
   "updated_at"  => now(),
  ]);
  $message = "Vendor Added Successfully ";
  return response()->json($message, 201);
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Vendor  $vendor
  * @return \Illuminate\Http\Response
  */
 public function show(Vendor $vendor)
 {
  return Vendor::find($vendor);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Vendor  $vendor
  * @return \Illuminate\Http\Response
  */
 public function edit(Vendor $vendor)
 {

 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Vendor  $vendor
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Vendor $vendor)
 {
    $request->validate([
        'username'    => 'required',
        'email'       => 'required',
        'password'    => 'required',
        'store_name'  => 'required',
        'name'        => 'required',
        'store_phone' => 'required',
        'address_one' => 'required',
       ]);
       Vendor::updated([
        'username'    => $request->username,
        'email'       => $request->email,
        'password'    => $request->password,
        'name'        => $request->name,
        'store_name'  => $request->store_name,
        'address_two' => $request->address_two,
        'address_one' => $request->address_one,
        'country'     => $request->country,
        'city'        => $request->city,
        'state'       => $request->state,
        'zipecode'    => $request->zipecode,
        'store_phone' => $request->store_phone,
        "created_at"  => Carbon::now(),
        "updated_at"  => now(),
       ]);
       $message = "Vendor Added Successfully ";
       return response()->json($message, 201);
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Vendor  $vendor
  * @return \Illuminate\Http\Response
  */
 public function destroy(Vendor $vendor)
 {
  $vendor->delete();
  return response('Successfully Deleted.');
 }
}
