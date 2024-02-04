<?php

namespace App\Http\Controllers\web;

use App\Models\cart;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function dataCart(Request $req){
        $user_id=Auth::guard("web")->user()->id;
        $data_cart=cart::where("product_id",$req->product_id)->where("user_id",$user_id)->first();
        if($data_cart){
            $data_cart->increment("count");
        }else{
            $cart=new cart();
            $cart->user_id=$user_id;
            $cart->product_id=$req->product_id;
            $cart->count=1;
            $cart->save();
            return "success added to cart";
        }
    }

    public function remove(Request $req){
        $user_id=Auth::guard("web")->user()->id;
        DB::table('carts')
        ->where("product_id",$req->product_id)
        ->where("user_id",$user_id)->delete();
    }


    public function search(Request $request){
        //  $search=$req->search;

        if($request->search){

            $pro_search=DB::table("products")->where('name', 'like', '%' . $request->search . '%')->get(["name","id"]);
            foreach ( $pro_search as $pro_search )


        //    echo "
        //    <li class='list-group-item'>
        //         <i class='lni lni-search-alt text-muted'></i>
        //         <a href='{{route('web/Product_details',$pro_search->id)}}' class='m-1 text-muted'>
        //         $pro_search->name</a>
        //    </li>
        //    ";

           echo '
    <li class="list-group-item">
        <i class="lni lni-search-alt text-muted"></i>
        <a href="' . route('web/Product_details', ['id'=>$pro_search->id]) . '" class="m-1 text-muted">
            ' . $pro_search->name . '
        </a>
    </li>
';

        }

    }
}
