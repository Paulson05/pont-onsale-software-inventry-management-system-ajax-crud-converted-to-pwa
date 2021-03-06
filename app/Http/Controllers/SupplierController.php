<?php

namespace App\Http\Controllers;

use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\User\StoreUserFormRequest;
use App\Models\Supplier;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.supplier.index');
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

//    public function store(StoreSupplierRequest $request)
//    {
//
//
//      $check = Supplier::create($request->validated());
//      $arr = array('msg' => 'blb bla bl', 'status' => false );
//     if ($check){
//         $arr = array('msg' => 'succeccfully', 'status' => true );
//     }
//           return Response()->json($arr);
//    }
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(),[

            'name' => 'required',
            'email'=>  'required',
            'mobile_no' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{

            $post = Supplier::create(collect($request->only(['name','email','mobile_no','address']))->all());
            $status =    $post->save();
//        $supplier->created_by = Auth::user()->id;

            return response()->json([
                'status' => 200,
                'message' => 'post added successfully',

            ]);
        }


    }

    public function fetchSupplier(){
        $suppliers = Supplier::all();
        return response()->json([
            'suppliers'=>$suppliers,
        ]);
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

    public function edit($id)
    {

        $supplier =Supplier::find($id);

        if ($supplier)
        {
            return response()->json([
                'status' => 200,
                'supplier' => $supplier,

            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'message' => 'supllier added succesfully',

            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required',
            'email'=>  'required',
            'mobile_no' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else{
            $supplier = Supplier::find($id);
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->mobile_no= $request->mobile_no;
            $supplier->address = $request->address;
//        $supplier->created_by = Auth::user()->id;
            $supplier->update();

            return response()->json([
                'status' => 200,
                'message' => 'post added successfully',

            ]);
        }
    }

    public function destroy($id)
    {
        $post = Supplier::find($id);
        $post->delete();
        return response()->json([
            'status' => 200,
            'message' => 'post deleted successfully',

        ]);
    }
}
