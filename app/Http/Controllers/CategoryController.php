<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.categoryManagement');
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $category = new Category();
            $category->name = $request->name;

//        $supplier->created_by = Auth::user()->id;
            $category->save();

            return response()->json([
                'status' => 200,
                'message' => 'post added successfully',

            ]);
        }
    }

    public function fetchCategory(){
        $category = Category::all();
        return response()->json([
            'category'=>$category,
        ]);
    }


    public function show(Category $category)
    {
        //
    }


    public function edit( $id)
    {
        $category =Category::find($id);

        if ( $category)
        {
            return response()->json([
                'status' => 200,
                'category' => $category,

            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'message' => 'category added succesfully',

            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $category = Category::find($id);
            $category->name = $request->name;

//        $supplier->created_by = Auth::user()->id;
            $category->update();

            return response()->json([
                'status' => 200,
                'message' => 'post added successfully',

            ]);
        }
    }

    public function destroy($id)
    {
        $post = Category::find($id);
        $post->delete();
        return response()->json([
            'status' => 200,
            'message' => 'post deleted successfully',

        ]);
    }
}
