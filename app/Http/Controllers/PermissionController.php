<?php

namespace App\Http\Controllers;

use App\Http\Requests\permmisiom\StorePermissionFromRequest;
use App\Http\Requests\Role\StoreRoleFormRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){
        return view('backend.permission.index');
    }
    public function store(StorePermissionFromRequest $request)
    {

        $data= $request->all();
        $slug=Str::slug($request->input('name'));
        $slug_count=Role::where('slug', $slug)->count();
        if ($slug_count){
            $slug = time(). '_'. $slug;
        }
        $data['slug']=$slug;


       $status = Permission::create($data);
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
}
