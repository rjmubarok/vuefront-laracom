<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  return Product::all();
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
   'name' => 'required',
   'price' => 'required',
  ]);
  Product::create([
   'category_id' => $request->category_id,
   'brand_id'    => $request->brand_id,
   'price'       => $request->price,
   'name'        => $request->name,
   'code'        => $request->code,
   'slug'        => Str::slug($request->name),
   'description' => $request->description,
   'Image'       => $request->Image,
   'status'      => 1,
   'Parent_id'   => $request->Parent_id,
  ]);
  $message = "Catewgory added Successfully ";
  return response()->json(['message', $message], 201);
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Product  $product
  * @return \Illuminate\Http\Response
  */
 public function show(Product $product)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Product  $product
  * @return \Illuminate\Http\Response
  */
 public function edit(Product $product)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Product  $product
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Product $product)
 {
    $request->validate([
        'name' => 'required',
        'price' => 'required',
       ]);
       $product->update([
        'category_id' => $request->category_id,
        'brand_id'    => $request->brand_id,
        'price'       => $request->price,
        'name'        => $request->name,
        'code'        => $request->code,
        'slug'        => Str::slug($request->name),
        'description' => $request->description,
        'Image'       => $request->Image,
        'status'      => 1,
        'Parent_id'   => $request->Parent_id,
       ]);
       $message = "Catewgory added Successfully ";
       return response()->json(['message', $message], 201);
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Product  $product
  * @return \Illuminate\Http\Response
  */
 public function destroy(Product $product)
 {
    $product = Product::find($product);
    $product->delete();
  
    return response()->json();
 }
}
