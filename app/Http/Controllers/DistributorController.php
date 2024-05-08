<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Distributors',
        ];
        $distributors = Distributor::all();

        return view('distributor.manage', compact('pageData','distributors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add Distributor',
        ];
        return view('distributor.add', compact('pageData'));
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
            'name' => 'required',
            'phone_number' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $distributor = new Distributor();
        $distributor->name = $request->name;
        $distributor->phone_number = $request->phone_number;
        $distributor->business_name = $request->business_name;
        $distributor->address = $request->address;
        $distributor->created_by = auth()->user()->id;
        $distributor->save();

        if($distributor){
            return redirect()->route('distributors')->with("success","Distributor is created successfully.");
        }else{
            return redirect()->route('distributors')->with("error","Distributor is not created due to some reason.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageData = [
            'pageTitle' => 'Edit Distributor',
        ];
        $distributor = Distributor::where('id',$id)->first();

        return view('distributor.edit', compact('pageData', 'distributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $distributor = Distributor::find($id);
        $distributor->name = $request->name;
        $distributor->phone_number = $request->phone_number;
        $distributor->address = $request->address;
        $distributor->business_name = $request->business_name;
        $distributor->updated_by = auth()->user()->id;
        $distributor->update();

        if($distributor){
            return redirect()->route('distributors')->with("success","Distributor is updated successfully.");
        }else{
            return redirect()->route('distributors')->with("error","Distributor is not updated due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distributor = Distributor::where('id', $id)->delete();
        if($distributor){
            return redirect()->route('distributors')->with("success","Distributor is deleted successfully.");
        }else{
            return redirect()->route('distributors')->with("error","Distributor is not deleted due to some reason.");
        }
    }
}
