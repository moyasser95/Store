<?php

namespace App\Providers;

use App\Models\cart;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class CartProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer("web/*",function($view){
            if(Auth::guard('web')->user()){

                $id_login=Auth::guard('web')->user()->id;
                $data_cart=cart::where("user_id",$id_login)->with("products.images")->get();

                $num_pro=cart::where("user_id",$id_login)->count();
                $view->with(["data_cart"=>$data_cart,"num_pro"=>$num_pro]);
            }

               



        });
    }
}
