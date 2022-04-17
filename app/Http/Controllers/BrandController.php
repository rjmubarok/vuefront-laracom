<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
    $brands = Brand::paginate(10);
    return response()->json($brands, 200);
 }
 public function getAll($id)
 {
     return response()->json(Brand::all()->except($id), 200);
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
    $success = false;
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $file_name = null;
        if ($request->image) {
            $file      = explode(';', $request->image);
            $file      = explode('/', $file[0]);
            $file_ex   = end($file);
            $file_name = uniqid() . '.' . $file_ex;
        }
        $success = Brand::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'description'   => $request->description,
            'status'        => $request->status,
            'image'         => $file_name,
        ]);
        if ($success && $file_name) {
            Image::make($request->image)->save(public_path('storage/brand/') . $file_name);
            Image::make($request->image)->resize(320, 240)->save(public_path('storage/brand/thumbs/') . $file_name);
        }
        return response()->json([
            'success' => $success,
        ], 200);
 }
 public function bulkcreate(Request $request)
 {
     $request->validate(([
         'name' => 'required'
     ]));

     $names = explode(",", $request->name);

     if (is_array($names)) {
         $n = 0;
         foreach ($names as $name) {
             $name = trim($name);
             if (!empty($name)) {
                 Brand::insert([
                     'name' => $name,
                     'slug' => Str::slug($name)
                 ]);
                 $n++;
             }
         }
     }

     return response()->json($n . " Brand inserted.");
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show(Brand $brand)
 {
    return response()->json($brand, 200);
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
    ]);
    //Storage::delete(['category/' . $category->image, 'category/thumbs/' . $category->image]);
    $brand->name = $request->name;
    $brand->slug = Str::slug($request->name);
    $brand->status = $request->status;
    $brand->description = $request->description;
    if ($request->image) {
        $file      = explode(';', $request->image);
        $file      = explode('/', $file[0]);
        $file_ex   = end($file);
        $file_name = uniqid() . '.' . $file_ex;
        Image::make($request->image)->save(public_path('storage/brand/') . $file_name);
        Image::make($request->image)->resize(320, 240)->save(public_path('storage/brand/thumbs/') . $file_name);

        if ($brand->image) {
            Storage::delete(['public/brand/' . $brand->image, 'public/brand/thumbs/' . $brand->image]);
        }
        $brand->image = $file_name;
    }

    $brand->update();

    return response()->json($brand, 200);
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy(Brand $brand)
 {
    $image = $brand->image;
    $deleted = $brand->delete();
    if ($image && $deleted) {
        Storage::delete(['public/brand/' . $image, 'public/brand/thumbs/' . $image]);
    }
    return $deleted ? response('Successfully Deleted.') : response('Something went wrong', http_response_code());
 }
 public function bulkdelete(Request $request)
 {
     foreach ($request->ids as $id) {
         $brand = Brand::find($id);
         $image = $brand->image;
         $deleted = $brand->delete();
         if ($image && $deleted) {
             Storage::delete(['public/brand/' . $image, 'public/brand/thumbs/' . $image]);
         }
     }
     return response()->json(count($request->ids));
 }


 public function changestatus(Request $request)
 {
     return Brand::whereIn('id', $request->ids)->update(['status' =>  $request->status]) ?
         response()->json(count($request->ids)) :
         response()->json(0);
 }
}
