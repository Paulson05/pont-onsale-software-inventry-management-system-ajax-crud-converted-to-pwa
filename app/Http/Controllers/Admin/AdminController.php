<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        $users= User::all();
        return view('backend.dashboard', [  'users' =>  $users]);
    }
    public  function logOut(){

        Auth::logout();
        return redirect()->route('loginpage');
    }
}
