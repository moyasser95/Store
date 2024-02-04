<?php

namespace App\Http\Controllers\dashboard\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCheckController extends Controller
{
    public function check(Request $request){
    $data_admin=$request->only("email","password");
    if(Auth::guard('admin')->attempt($data_admin)){
        return redirect()->route('admin.index')->with("ms_admin","Welcome ". Auth::guard('admin')->user()->name);
    }else{
        return redirect()->route('admin/login')->with("ms_admin","Email OR Password Incorrect");

    }
    }

    public function logout(){
        Auth::guard("admin")->logout();
        return redirect()->route('admin/login');


    }
}
