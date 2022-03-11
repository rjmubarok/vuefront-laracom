<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
class BrandController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
    $brands = Brand::all();
    return response()->json([
        'brands' => $brands
    ], 200);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {

 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
//   $request->validate([
//    'name'        => 'required',
//   ]);
//   Brand::create([
//    'name'        => $request->name,
//    'description' => $request->description,
//    'image'       => $request->image,
//   ]);
//   $message = "Catewgory added Successfully ";
//   return response()->json(['message', $message], 201);
$success = false;
$request->validate([
    'name' => 'required|unique:brands,name,except,id',
    'name' => 'required',
    'status' => 'required'
]);
$file      = explode(';', $request->image);
$file      = explode('/', $file[0]);
$file_ex   = end($file);
$file_name = date('YmdHi') . '.' . $file_ex;
$success = Brand::create([
    'name'       => $request->name,
    'slug'        => Str::slug($request->name),
    'description'     => $request->description,
    'status'      => $request->status,
    'image'         =>$file_name ,

]);
if ($success) {
    Image::make($request->image)->save(public_path('uploades/') . $file_name);
}
return response()->json([
    'success' => $success,
], 200);
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($slug)
 {
    $brand = Brand::where('slug', $slug)->first();
    return response()->json(['brand' => $brand], 200);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function edit($id)
 {

 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Brand $brand)
 {
    $request->validate([
        'name' => "required|unique:categories,name,$brand->id",
        'status' => 'required',
    ]);
    $category = Brand::find($request->id);
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    $category->status = $request->status;
    $category->description = $request->description;

    $file      = explode(';', $request->image);
    $file      = explode('/', $file[0]);
    $file_ex   = end($file);
    $file_name = date('YmdHi') . '.' . $file_ex;
     $category->image = $file_name;
    if ($category) {
        Image::make($request->image)->save(public_path('uploades/') . $file_name);
    }
    $category->update();
    return response()->json(['category', $category],200);
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy(Brand $brand)
 {
    $brand->delete();
    return response('Successfully Deleted.');
 }
 public function removeitem(Request $request){
    $sl =0;
    foreach($request->ids as $id){
       $category=Brand::find($id);
        $category->delete();
        $sl++;

    }
    $success = $sl>0? true:false;
    return response()->json([
        'success'=>$success ,
        'total'=>$sl
    ],200);
}
public function ChangeStatus(Request $request){
    $sl =0;
    foreach($request->ids as $id){
       $category=Brand::find($id);
       $category->status=$request->status;
        $category->update();
        $sl++;

    }
    $success = $sl>0? true:false;
    return response()->json([
        'success'=>$success ,
        'total'=>$sl
    ],200);
}
}


