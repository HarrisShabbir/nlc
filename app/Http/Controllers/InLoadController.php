<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleDetail;
use App\Models\Distributor;
use App\Models\InLoad;
use App\Models\Shift;
use App\Models\Vehicle;
use App\Models\VehicleDetail;
use App\Models\VendorPool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'In Loads',
        ];
        $inloads = InLoad::all();

        return view('inload.manage', compact('pageData','inloads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add In Load',
        ];
        $distributors = Distributor::all();
        $vendorpools = VendorPool::all();
        $articles = Article::all();
        return view('inload.add', compact('pageData', 'distributors', 'vendorpools', 'articles'));
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
            'distributor_id' => 'required',
            'vendor_pool_id' => 'required',
            'type' => 'required',
            'way_bill' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $inload = new InLoad();
        $time = date("H:i:s");
        $shift_id = Shift::where('time_from','<',$time)->where('time_to','>',$time)->pluck('id')->first();
        $inload->shift_id = !is_null($shift_id) ? $shift_id : NULL;
        $inload->distributor_id = $request->distributor_id;
        $inload->vendor_pool_id = $request->vendor_pool_id;
        $inload->type = $request->type;
        $inload->way_bill = $request->way_bill;
        $inload->created_by = auth()->user()->id;
        $inload->save();

        if($inload){

            for($i=0; $i<=count($request->article_id)-1;$i++){
                //$article_weight = Article::where('id',$request->article_id[$i])->pluck('weight')->first();
                //$total_weight =  $request->quantity[$i] * $article_weight;
                $inload->articledetails()->attach($inload->id, ['article_id'=> $request->article_id[$i], 'quantity'=>$request->quantity[$i], 'total_weight' => $request->total_weight[$i]]);
            }
            for($j=0; $j<=count($request->vehicle_id)-1;$j++){
                $inload->vehicledetails()->attach($inload->id, ['vehicle_id'=> $request->vehicle_id[$j]]);
            }

            return redirect()->route('inloads')->with("success","Inload is created successfully.");
        }else{
            return redirect()->route('inloads')->with("error","Inload is not created due to some reason.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InLoad  $inLoad
     * @return \Illuminate\Http\Response
     */
    public function show(InLoad $inLoad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InLoad  $inLoad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageData = [
            'pageTitle' => 'Edit In Load',
        ];
        $inload = InLoad::find($id);
        $articleDetails = ArticleDetail::where('detailable_id', $id)->where('detailable_type','App\Models\InLoad')->get();
        $vehicleDetails = VehicleDetail::where('detailable_id', $id)->where('detailable_type','App\Models\InLoad')->get();
        $distributors = Distributor::all();
        $vendorpools = VendorPool::all();
        $articles = Article::all();
        $vehicles = Vehicle::all();

        return view('inload.edit', compact('pageData', 'inload', 'distributors', 'vendorpools', 'articles', 'vehicles', 'articleDetails', 'vehicleDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InLoad  $inLoad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'distributor_id' => 'required',
            'vendor_pool_id' => 'required',
            'type' => 'required',
            'way_bill' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $inload = InLoad::find($id);
        $inload->distributor_id = $request->distributor_id;
        $inload->vendor_pool_id = $request->vendor_pool_id;
        $inload->type = $request->type;
        $inload->way_bill = $request->way_bill;
        $inload->created_by = auth()->user()->id;
        $inload->save();

        if($inload){

            for($i=0; $i<=count($request->article_id)-1;$i++){
                //$article_weight = Article::where('id',$request->article_id[$i])->pluck('weight')->first();
                //$total_weight =  $request->quantity[$i] * $article_weight;
                $inload->articledetails()->attach($inload->id, ['article_id'=> $request->article_id[$i], 'quantity'=>$request->quantity[$i], 'total_weight' => $request->total_weight[$i]]);
            }
            for($j=0; $j<=count($request->vehicle_id)-1;$j++){
                $inload->vehicledetails()->attach($inload->id, ['vehicle_id'=> $request->vehicle_id[$j]]);
            }

            return redirect()->route('inloads')->with("success","Inload is created successfully.");
        }else{
            return redirect()->route('inloads')->with("error","Inload is not created due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InLoad  $inLoad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inload = InLoad::find($id);
        $inload->articledetails()->detach();
        $inload->vehicledetails()->detach();
        if($inload->delete()){
            return redirect()->route('inloads')->with("success","Inload is deleted successfully.");
        }else{
            return redirect()->route('inloads')->with("error","Inload is not deleted due to some reason.");
        }
    }

    public function getVehicles($vendor_pool_id){

        $vehicles = Vehicle::where('vendor_pool_id', $vendor_pool_id)->get();
        return $vehicles;

    }
}
