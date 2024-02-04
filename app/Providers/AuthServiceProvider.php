<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        foreach(config('permission')['permissions'] as $val){

            Gate::define($val,function($user)use($val){

                $id_user=Auth::guard('admin')->user()->id;

                $type_admin=Admin::findOrFail($id_user)->type->permissions;
                return in_array($val,$type_admin)?true:false;
            });
        }




        // Gate::define("view_User",function($user){
        //     return true;
        // });
    }
}
