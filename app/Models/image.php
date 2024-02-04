<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class image extends Model
{
    use HasFactory;

    protected $fillable=['product_id',"file"];


    public function product(){
        return $this->belongsTo(product::class,"id","product_id");
    }


    public static function saveImage($img,$product_id){
        foreach($img["img"] as $img){
            $new_name=md5(uniqid()).".".$img->extension();
            image::create([
                "product_id"=>$product_id,
                "file"=>$new_name
            ]);
            $img->storeAs('public/images',$new_name);
        }

    }




    public static function deleteImage($img){
        foreach($img as $img){
            unlink(storage_path('app/public/images/'.$img));
        }
    }
}
