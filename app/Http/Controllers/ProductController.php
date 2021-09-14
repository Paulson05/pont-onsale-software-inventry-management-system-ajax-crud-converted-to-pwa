<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Picqer;
class ProductController extends Controller
{

    public function index()
    {
//     $products = Product::where('unit_id', 'suppliers_id', 'category_id')->with()->get();
//     $products = Product::all();
        $products =   Product::with(array('category'=>function($query){
            $query->select('id','name');
        }))->get();
        return view('backend.pages.product.index')->with([
            'products' => $products,
        ]);
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
        $request->all();
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'suppliers_id'=>  'required',
            'unit_id' => 'required',
            'category_id' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $product_code = rand(106890128, 100000000);
            $redColor = '255, 0, 0';
            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
            $barcodes =  $generator->getBarcode($product_code,  $generator::TYPE_STANDARD_2_5, 2, 60);
            $product = new Product();
            $product->suppliers_id = $request->suppliers_id;
            $product->name = $request->name;
            $product->unit_id = $request->unit_id;
            $product->product_code = $product_code;
            $product->barcode = $barcodes;
            $product->category_id = $request->category_id;
//        $supplier->created_by = Auth::user()->id;
            $product->save();

            return response()->json([
                'status' => 200,
                'message' => 'post added successfully',

            ]);
        }
    }
    public function  fetchProduct(){
        $products = Product::all();
        return response()->json([
            'products'=>$products,
        ]);
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


    public function edit($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'status' => 200,
                'product' => $product,

            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'product added succesfully',

            ]);
        }
    }


    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $post = Product::find($id);
        $post->delete();
        return response()->json([
            'status' => 200,
            'message' => 'post deleted successfully',

        ]);
    }

    public function getProductCode(){
        $productBarCode = Product::select('barcode','product_code' )->get();
        return view('backend.pages.product.productbarcode')->with([
            'productBarCode' =>  $productBarCode
        ]);
    }
}
