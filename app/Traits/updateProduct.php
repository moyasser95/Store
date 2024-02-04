<?php
namespace App\traits;

use App\Models\product;
use App\Models\image;



trait UpdateProduct{
    public function UpdateProduct($request,$id){
        $product=$request->except('img','_method','_token');
        product::where('id',$id)->update($product);

       $img=image::where("product_id",$id)->pluck("file");
       image::deleteImage($img);
       image::where('product_id',$id)->delete();

       $file=$request->only("img");
       Image::saveImage($file,$id);
    return redirect()->route('product.index')->with('ms_admin',"the product has been EDIT successfully");

    }
}
