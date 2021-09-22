<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserFormRequest;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request  $request){

        $users= User::all();
        $roles = Role::all();
        if ($request->ajax()){

            $roles = Role::where('id', $request->role_id)->first();

            $permissions = $roles->permissions;
            return   $permissions;
        }
        return view('backend.dashboard', [  'users' =>  $users, 'roles' =>$roles]);
    }
  public function create(Request $request){

  }
    public function postRegister(StoreUserFormRequest $request){

     $user = User::create($request->validated());
        if($request->role != null){
            $user->roles()->sync($request->role);
            $user->save();
        }

        if($request->permissions != null){
            foreach ($request->permissions as $permission) {
                $user->permissions()->sync($permission);
                $user->save();
            }
        }
        return response()->json([
            'status' => 200,
            'message' => 'new user added successfully',

        ]);
    }
    public function fetchUser(){
        $users = User::all();
        $us = Supplier::all();
            $users = [
            'users'=>$users,
              'us' =>  $us
            ];
        return response()->json($users);
    }
    public  function logOut(){

        Auth::logout();
        return redirect()->route('loginpage');
    }
}
