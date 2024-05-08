<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Shifts',
        ];
        $shifts = Shift::all();

        return view('shift.manage', compact('pageData','shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add Shift',
        ];
        return view('shift.add', compact('pageData'));
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
            'title' => 'required',
            'time_from' => 'required',
            'time_to' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $shift = new Shift();
        $shift->title = $request->title;
        $shift->time_from = $request->time_from;
        $shift->time_to = $request->time_to;
        $shift->status = $request->status;
        $shift->created_by = auth()->user()->id;
        $shift->save();

        if($shift){
            return redirect()->route('shifts')->with("success","Shift is created successfully.");
        }else{
            return redirect()->route('shifts')->with("error","Shift is not created due to some reason.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageData = [
            'pageTitle' => 'Edit Shift',
        ];
        $shift = Shift::where('id',$id)->first();

        return view('shift.edit', compact('pageData', 'shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'time_from' => 'required',
            'time_to' => 'required'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $shift = Shift::find($id);
        $shift->title = $request->title;
        $shift->time_from = $request->time_from;
        $shift->time_to = $request->time_to;
        $shift->status = $request->status;
        $shift->updated_by = auth()->user()->id;
        $shift->update();

        if($shift){
            return redirect()->route('shifts')->with("success","Shift is updated successfully.");
        }else{
            return redirect()->route('shifts')->with("error","Shift is not updated due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = Shift::where('id', $id)->delete();
        if($shift){
            return redirect()->route('shifts')->with("success","Shift is deleted successfully.");
        }else{
            return redirect()->route('shifts')->with("error","Shift is not deleted due to some reason.");
        }
    }
}
