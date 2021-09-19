<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleFormRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('backend.role.index');
    }

    public function store(StoreRoleFormRequest $request)
    {
        Role::create($request->validated());


        return response()->json([
            'status' => 200,
            'message' => 'post added successfully',

        ]);

    }
    public function  fetchRole(){
        $roles = Role::all();
        return response()->json([
            'roles'=>$roles,
        ]);
    }

    public function show(unit $unit)
    {
        //
    }


    public function edit($id)
    {

        $role =Role::find($id);

        if ($role)
        {
            return response()->json([
                'status' => 200,
                'role' => $role,

            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'message' => 'unit added succesfully',

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
                $unit =  Role::find($id);
            $unit->name = $request->name;

//        $supplier->created_by = Auth::user()->id;
            $unit->update();

            return response()->json([
                'status' => 200,
                'message' => 'unit added successfully',

            ]);
        }
    }

    public function destroy($id)
    {
        $post = Role::find($id);
        $post->delete();
        return response()->json([
            'status' => 200,
            'message' => 'post deleted successfully',

        ]);
    }

}
