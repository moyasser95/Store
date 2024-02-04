<?php

namespace App\Http\Controllers\dashboard\admin;


use FFI\Exception;
use App\Models\Admin;
use App\Models\AdminType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $check=Gate::forUser(Auth::guard('admin')->user())->allows('view_user');

        if($check){

         $data=Admin::with('type')->get();
        return view('dash.admin.view',compact('data'));
        }else{
         abort('403');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dash.admin.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        DB::beginTransaction();
        try{
            $data_admin=$request->except("prive","permissions","_token","password_confirmation");
            $insert_admin=Admin::create($data_admin);

            $admin_id=$insert_admin->id;

            $req=$request->only("prive","permissions");

            AdminType::create_type($admin_id,$req);
            DB::commit();
            return redirect()->route('admin.index')->with('ms_admin',"success add user");
        }catch(Exception $e){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data= Admin::where('id', $id)->with('type')->get()[0];

        return view('dash.admin.edite',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin=$request->only("name","email","gender");
        Admin::where('id',$id)->update($admin);
        $admin_type=$request->only("prive","permissions");
         AdminType::update_admin_type($admin_type, $id);
         return redirect()->route('admin.index')->with("ms_admin","success update admin");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with("ms_admin","success Delete admin");

    }
}
