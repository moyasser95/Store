<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\image;
class product extends Model
{
    use HasFactory;

    protected $fillable=['name','price','sale','count','cateogry'];

    public function images(){
        return $this->hasMany(image::class,"product_id",'id');
    }

    public function users(){
        return $this->belongsToMany(User::class,"carts");
    }
}
