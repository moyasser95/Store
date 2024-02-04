<?php

namespace App\Http\Controllers\web;

use App\Models\cart;
use App\Models\User;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index(){
        // $id_login=Auth::guard('web')->user()->id;
        // return cart::where("user_id",$id_login)->with("products.images")->get();


        $data=product::with('images')->get();
        return  view('web.index',compact('data'));
    }


    public function register(){
        return view('web.register');
    }
    public function data(Request $request){
        User::create($request->toArray());
        return redirect()->route('web/index');
    }

    public function login(){
        return view('web.login');
    }
    public function check(Request $request){
    $check=Auth::guard('web')->attempt(["email"=>$request->input('email'),"password"=>$request->input('password')]);
    if ($check) {
       return redirect()->route('web/index');
    }else{
       return redirect()->route('web/login');
    }
    }

    public function Product_details(Request $req){
        // return $req;
         $pro_details= product::with('images')->where("id",$req->id)->get();
         return view('web.product-details',compact('pro_details'));
    }
}
