<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'user_name'=> 'required',
            'password'=> 'required'
        ]);

        $user = User::where('user_name', $request->user_name)->first();
        if(!($user && Hash::check($request->password, $user->password))){
            session()->flash('alert_message', ['message'=>"Incorrect user name or password", 'icon'=>'error']);
            return redirect()->back();
        }
        session(['userLogin'=> $user]); 
        return redirect('/dashboard');
    }

    public function logout(){
        session()->forget('userLogin'); 
        session()->flash('sweet_alert.alert', ['message'=>"Success", 'icon'=>'success']);
        return redirect('/dashboard/login');
    }
}
