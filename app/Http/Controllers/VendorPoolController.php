<?php

namespace App\Http\Controllers;

use App\Models\VendorPool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorPoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Vendor Pools',
        ];
        $vendorPools = VendorPool::all();

        return view('vendor-pool.manage', compact('pageData','vendorPools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add Vendor Pool',
        ];
        return view('vendor-pool.add', compact('pageData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $vendorPool = new VendorPool();
        $vendorPool->name = $request->name;
        $vendorPool->status = $request->status;
        $vendorPool->created_by = auth()->user()->id;
        $vendorPool->save();

        if($vendorPool){
            return redirect()->route('vendorpools')->with("success","Vendor Pool is created successfully.");
        }else{
            return redirect()->route('vendorpools')->with("error","Vendor Pool is not created due to some reason.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorPool  $vendorPool
     * @return \Illuminate\Http\Response
     */
    public function show(VendorPool $vendorPool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorPool  $vendorPool
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageData = [
            'pageTitle' => 'Edit Vendor Pool',
        ];
        $vendorPool = VendorPool::where('id',$id)->first();

        return view('vendor-pool.add', compact('pageData', 'vendorPool'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorPool  $vendorPool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $vendorPool = VendorPool::find($id);
        $vendorPool->name = $request->name;
        $vendorPool->status = $request->status;
        $vendorPool->updated_by = auth()->user()->id;
        $vendorPool->update();

        if($vendorPool){
            return redirect()->route('vendorpools')->with("success","Vendor Pool is updated successfully.");
        }else{
            return redirect()->route('vendorpools')->with("error","Vendor Pool is not updated due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorPool  $vendorPool
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendorPool = VendorPool::where('id', $id)->delete();
        if($vendorPool){
            return redirect()->route('vendorpools')->with("success","Vendor Pool is deleted successfully.");
        }else{
            return redirect()->route('vendorpools')->with("error","Vendor Pool is not deleted due to some reason.");
        }
    }
}
