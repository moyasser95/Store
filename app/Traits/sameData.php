<?php
namespace App\traits;

use App\Models\product;


trait sameData{
    public function same($request,$id){
        $check=product::where([
            "id"=>$id,
            "name"=>$request->name,
            "price"=>$request->price,
            "sale"=>$request->sale,
            "count"=>$request->count,
            "cateogry"=>$request->cateogry
         ])->first();
         if($check){
            return redirect()->route('product.index');
         }else{
            $data=$request->except('_method','_token');
            product::where('id',$id)->update($data);
            return redirect()->route('product.index');


         }
    }
}
