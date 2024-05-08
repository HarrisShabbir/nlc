<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VendorPool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Vehicles',
        ];
        $vehicles = Vehicle::all();

        return view('vehicle.manage', compact('pageData','vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add Vehicle',
        ];
        $drivers = Driver::all();
        $vendorpools = VendorPool::all();
        return view('vehicle.add', compact('pageData', 'drivers', 'vendorpools'));
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
            'driver_id' => 'required',
            'vendor_pool_id' => 'required',
            'registration_number' => 'required',
            'registration_year' => 'required',
            'maker_name' => 'required',
            'model_number' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $vehicle = new Vehicle();
        $vehicle->registration_number = $request->registration_number;
        $vehicle->model_number = $request->model_number;
        $vehicle->maker_name = $request->maker_name;
        $vehicle->registration_year = $request->registration_year;
        $vehicle->vendor_pool_id = $request->vendor_pool_id;
        $vehicle->driver_id = $request->driver_id;
        $vehicle->created_by = auth()->user()->id;
        $vehicle->save();

        if($vehicle){
            return redirect()->route('vehicles')->with("success","Vehicle is created successfully.");
        }else{
            return redirect()->route('vehicles')->with("error","Vehicle is not created due to some reason.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageData = [
            'pageTitle' => 'Edit Vehicle',
        ];
        $vehicle = Vehicle::where('id',$id)->first();
        $drivers = Driver::all();
        $vendorpools = VendorPool::all();
        return view('vehicle.edit', compact('pageData', 'vehicle', 'drivers', 'vendorpools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required',
            'vendor_pool_id' => 'required',
            'registration_number' => 'required',
            'registration_year' => 'required',
            'maker_name' => 'required',
            'model_number' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $vehicle = Vehicle::find($id);
        $vehicle->registration_number = $request->registration_number;
        $vehicle->model_number = $request->model_number;
        $vehicle->maker_name = $request->maker_name;
        $vehicle->registration_year = $request->registration_year;
        $vehicle->vendor_pool_id = $request->vendor_pool_id;
        $vehicle->driver_id = $request->driver_id;
        $vehicle->updated_by = auth()->user()->id;
        $vehicle->update();

        if($vehicle){
            return redirect()->route('vehicles')->with("success","Vehicle is updated successfully.");
        }else{
            return redirect()->route('vehicles')->with("error","Vehicle is not updated due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::where('id', $id)->delete();
        if($vehicle){
            return redirect()->route('vehicles')->with("success","Vehicle is deleted successfully.");
        }else{
            return redirect()->route('vehicles')->with("error","Vehicle is not deleted due to some reason.");
        }
    }
}
