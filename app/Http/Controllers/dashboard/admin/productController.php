<?php

namespace App\Http\Controllers\dashboard\admin;

use Exception;
use App\Models\image;
use App\Models\product;
use App\Traits\sameData;
use App\Traits\UpdateProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;

class productController extends Controller
{
    use sameData,UpdateProduct;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=product::with("images")->get();
        return view('dash.products.view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dash.products.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(productRequest $request)
    {
        DB::beginTransaction();
        try{

            $data_pro=product::create($request->except('img'));
            $product_id=$data_pro->id;
             $img=$request->only('img');
            image::saveImage($img,$product_id);
            DB::commit();
            return redirect()->route('product.index')->with('ms_admin',"the product has been added successfully");
        }catch(Exception $e){
            DB::rollback();
            return redirect()->route('product.create')->with("ms_admin","you have error");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $pro=product::findOrFail($id);
    return view('dash.products.edite',compact('pro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    if($request->has('img')){
        return $this->UpdateProduct($request,$id);
    }else{
        return $this->same($request,$id);
    }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $img=image::where("product_id",$id)->pluck("file");
        image::deleteImage($img);
        product::findOrFail($id)->delete();
        return redirect()->route('product.index')->with('ms_admin',"the product has been deleted successfully");

    }
}
