<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Drivers',
        ];
        $drivers = Driver::all();

        return view('driver.manage', compact('pageData','drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add Driver',
        ];
        $vehicles = Vehicle::all();
        return view('driver.add', compact('pageData', 'vehicles'));
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
            'phone_number' => 'required',
            'cnic' => 'required',
            'license_number' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $driver = new Driver();
        $driver->name = $request->name;
        $driver->phone_number = $request->phone_number;
        $driver->cnic = $request->cnic;
        $driver->license_number = $request->license_number;
        $driver->date_of_birth = $request->date_of_birth;
        $driver->nationality = $request->nationality;
        $driver->address = $request->address;
        $driver->vehicle_id = $request->vehicle_id;
        $driver->created_by = auth()->user()->id;
        $driver->save();

        if($driver){
            return redirect()->route('drivers')->with("success","Driver is created successfully.");
        }else{
            return redirect()->route('drivers')->with("error","Driver is not created due to some reason.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageData = [
            'pageTitle' => 'Edit Driver',
        ];
        $driver = Driver::find($id);
        $vehicles = Vehicle::all();
        return view('driver.edit', compact('pageData', 'driver', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'cnic' => 'required',
            'license_number' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $driver = Driver::find($id);
        $driver->name = $request->name;
        $driver->phone_number = $request->phone_number;
        $driver->cnic = $request->cnic;
        $driver->license_number = $request->license_number;
        $driver->date_of_birth = $request->date_of_birth;
        $driver->nationality = $request->nationality;
        $driver->address = $request->address;
        $driver->vehicle_id = $request->vehicle_id;
        $driver->updated_by = auth()->user()->id;
        $driver->update();

        if($driver){
            return redirect()->route('drivers')->with("success","Driver is updated successfully.");
        }else{
            return redirect()->route('drivers')->with("error","Driver is not updated due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::where('id', $id)->delete();
        if($driver){
            return redirect()->route('drivers')->with("success","Driver is deleted successfully.");
        }else{
            return redirect()->route('drivers')->with("error","Driver is not deleted due to some reason.");
        }
    }
}
