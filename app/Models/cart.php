<?php

namespace App\Models;

use App\Models\User;
use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cart extends Model
{
    use HasFactory;

    protected $table="carts";
    protected $fillable=['user_id','product_id','count'];

    public function users(){
        return $this->hasMany(User::class,"id","user_id");
    }
    public function products(){
        return $this->hasMany(product::class,"id","product_id");
    }
}
