<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return response()->json($categories,200);
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
        /**
         * Fillable fields
         *
         * name (string compulsory)
         * slug (string compulsory)
         * description (string nullable)
         * image (string nullable)
         * active (binary default 1)
         * parent_id (nullable)
         */
        $success = false;
        $request->validate([
            'name' => 'required|unique:categories,name',
            'status' => 'required'
        ]);
        
        $file_name = null;
        if($request->image){
            $file      = explode(';', $request->image);
            $file      = explode('/', $file[0]);
            $file_ex   = end($file);
            $file_name = date('YmdHi') . '.' . $file_ex;
        }
        $success = Category::create([
            'name'       => $request->name,
            'slug'        => Str::slug($request->name),
            'description'     => $request->description,
            'status'      => $request->status,
            'image'         =>$file_name ,

        ]);
        if ($success && $file_name) {
            Image::make($request->image)->save(public_path('uploades/') . $file_name);
            Image::make($request->image)->resize(320, 240)->save(public_path('uploades/thumbs/') . $file_name);
        }
        return response()->json([
            'success' => $success,
        ], 200);
        // $category = Category::create([
        //     'name' => $request->name,
        //     'slug' => Str::slug($request->name),
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'status'=>$request->status,
        //     'parent_id' => $request->parent_id,
        // ]);
        // $category = new Category;
        // $category->name = $request->name;
        // $category->description = $request->description;
        // $category->image = $request->image;
        // $category->slug = Str::slug($request->name, '_');
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $image_name = uniqid(). '.'. $ext;
        //     $file->move('storage/post' ,$image_name);
        //     $category->image = $image_name;
        //  }

        //  $category->save();
        // return response($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name' => "required|unique:categories,name,$category->id",
            'status' => 'required',
        ]);
        $category = Category::find($request->id);
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
        //  $category->update([
        //     'name' => $request->name,
        //     'slug' => Str::slug($request->name),
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'status'=>$request->status,
        //     'parent_id' => $request->parent_id,

        // ]);
        // // $file      = explode(';', $request->image);
        // // $file      = explode('/', $file[0]);
        // // $file_ex   = end($file);
        // // $file_name = date('YmdHi') . '.' . $file_ex;
        // //  $category->image = $file_name;
        // // if ($category) {
        // //     Image::make($request->image)->save(public_path('uploades/') . $file_name);
        // // }
        // return response()->json([
        //     'category' => $category,
        // ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();
        return response('Successfully Deleted.');
    }
    public function removeitem(Request $request){
        $sl =0;
        foreach($request->ids as $id){
           $category=Category::find($id);
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
           $category=Category::find($id);
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