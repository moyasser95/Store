<?php

namespace App\Models;

use App\Models\AdminType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table="admins";

    protected $fillable=['name','email','password','gender'];
    protected $hidden=['password','created_at','updated_at'];

    public function type(){
        return $this->hasOne(AdminType::class,"admin_id","id");
    }
    public function setPasswordAttribute($password){
        $this->attributes['password']=Hash::make($password);
    }
}
