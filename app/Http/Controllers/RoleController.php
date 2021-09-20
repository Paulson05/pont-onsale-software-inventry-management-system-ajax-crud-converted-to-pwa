<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleFormRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permmisions = Permission::orderBy('id', 'desc')->get();
        return view ('backend.role.index', ['permissions' => $permmisions]);
    }

    public function store(StoreRoleFormRequest $request)
    {


        $data= $request->all();
        $slug=Str::slug($request->input('name'));
        $slug_count=Role::where('slug', $slug)->count();
        if ($slug_count){
            $slug = time(). '_'. $slug;
        }
        $data['slug']=$slug;

       $status = Role::create($data);
        $status->permissions()->sync($request->name);
        $status->save();
        if ($status){
            return response()->json([
                'status' => 200,
                'message' => 'Role added successfully',

            ]);
        }
        else{
            return redirect()->back();

        }


    }
    public function  fetchRole(){
        $roles = Role::orderBy('id', 'desc')->get();
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
