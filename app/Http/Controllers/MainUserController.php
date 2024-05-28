<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class MainUserController extends Controller
{
    //
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
    }
}
