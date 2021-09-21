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
    public function dashboard(){

        $users= User::all();
        return view('backend.dashboard', [  'users' =>  $users]);
    }
  public function create(Request $request){
      if ($request->ajax()){
          $roles = Role::where('id', $request->id)->first();
          dd($roles);
          $permissions = $roles->permissions;
          return   $permissions;
      }
  }
    public function postRegister(StoreUserFormRequest $request){

     $user = User::create($request->validated());
     return response()->json($user, 200);
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
