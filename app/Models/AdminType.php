<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminType extends Model
{
    use HasFactory;

    protected $table="admin_types";
    protected $fillable=['admin_id','prive','permissions'];
    protected $hidden=['id','created_at','updated_at'];


    public function getPermissionsAttribute($permisson){
        return explode("+",$permisson);
    }


    public static function update_admin_type($admin_type, $id){
         $per=implode("+",$admin_type["permissions"]);
         $prive=$admin_type['prive'];
        AdminType::where('admin_id',$id)->update([
            "prive"=>$prive,
            "permissions"=>$per
        ]);


    }




    public function admin()
    {
        return $this->belongsTo(Admin::class,"id","admin_id");
    }

    public static function create_type($admin_id,$req){
       $str_permission=implode("+",$req["permissions"]);
        AdminType::create([
            "admin_id"=>$admin_id,
            "prive"=>$req['prive'],
            "permissions"=>	$str_permission,
        ]);

    }
}
