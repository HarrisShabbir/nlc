<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleDetail;
use App\Models\Distributor;
use App\Models\InLoad;
use App\Models\OutLoad;
use App\Models\Shift;
use App\Models\Vehicle;
use App\Models\VehicleDetail;
use App\Models\VendorPool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OutLoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Out Loads',
        ];
        $outloads = OutLoad::all();

        return view('outload.manage', compact('pageData','outloads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add Out Load',
        ];
        $distributors = Distributor::all();
        $vendorpools = VendorPool::all();
        $articles = Article::all();
        return view('outload.add', compact('pageData', 'distributors', 'vendorpools', 'articles'));
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
            'dispatch_date' => 'required',
            'shipment_number' => 'required',
            'bilti_number' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $time = date("H:i:s");
        $shift_id = Shift::where('time_from','<',$time)->where('time_to','>',$time)->pluck('id')->first();
        if(is_null($shift_id)){
            return back()->with("error","If you want to enter the record. Please create a shift first that covers current time.");
        }
        $outload = new OutLoad();
        $outload->shift_id = !is_null($shift_id) ? $shift_id : NULL;
        $outload->distributor_id = $request->distributor_id;
        $outload->vendor_pool_id = $request->vendor_pool_id;
        $outload->dispatch_date = $request->dispatch_date;
        $outload->shipment_number = $request->shipment_number;
        $outload->bilti_number = $request->bilti_number;
        $outload->created_by = auth()->user()->id;
        $outload->save();

        if($outload){

            for($i=0; $i<=count($request->article_id)-1;$i++){
                $article_weight = Article::where('id',$request->article_id[$i])->pluck('weight')->first();
                $total_weight =  $request->quantity[$i] * $article_weight;
                $outload->articledetails()->attach($outload->id, ['article_id'=> $request->article_id[$i], 'quantity'=>$request->quantity[$i], 'total_weight' => $request->total_weight[$i]]);
            }
            for($j=0; $j<=count($request->vehicle_id)-1;$j++){
                $outload->vehicledetails()->attach($outload->id, ['vehicle_id'=> $request->vehicle_id[$j]]);
            }

            return redirect()->route('outloads')->with("success","Out Load is created successfully.");
        }else{
            return redirect()->route('outloads')->with("error","Out Load is not created due to some reason.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutLoad  $outLoad
     * @return \Illuminate\Http\Response
     */
    public function show(OutLoad $outLoad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutLoad  $outLoad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageData = [
            'pageTitle' => 'Edit Out Load',
        ];
        $outload = OutLoad::find($id);
        $articleDetails = ArticleDetail::where('detailable_id', $id)->where('detailable_type','App\Models\OutLoad')->get();
        $vehicleDetails = VehicleDetail::where('detailable_id', $id)->where('detailable_type','App\Models\OutLoad')->get();
        $distributors = Distributor::all();
        $vendorpools = VendorPool::all();
        $articles = Article::all();
        $vehicles = Vehicle::all();

        return view('outload.edit', compact('pageData', 'outload', 'distributors', 'vendorpools', 'articles', 'vehicles', 'articleDetails', 'vehicleDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OutLoad  $outLoad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'distributor_id' => 'required',
            'vendor_pool_id' => 'required',
            'dispatch_date' => 'required',
            'shipment_number' => 'required',
            'bilti_number' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }
        $time = date("H:i:s");
        $shift_id = Shift::where('time_from','<',$time)->where('time_to','>',$time)->pluck('id')->first();
        if(is_null($shift_id)){
            return back()->with("error","If you want to enter the record. Please create a shift first that covers current time.");
        }
        $outload = new OutLoad();
        $outload->shift_id = !is_null($shift_id) ? $shift_id : NULL;
        $outload->distributor_id = $request->distributor_id;
        $outload->vendor_pool_id = $request->vendor_pool_id;
        $outload->dispatch_date = $request->dispatch_date;
        $outload->shipment_number = $request->shipment_number;
        $outload->bilti_number = $request->bilti_number;
        $outload->created_by = auth()->user()->id;
        $outload->save();

        if($outload){

            for($i=0; $i<=count($request->article_id)-1;$i++){
                //$article_weight = Article::where('id',$request->article_id[$i])->pluck('weight')->first();
                //$total_weight =  $request->quantity[$i] * $article_weight;
                $outload->articledetails()->attach($outload->id, ['article_id'=> $request->article_id[$i], 'quantity'=>$request->quantity[$i], 'total_weight' => $request->total_weight[$i]]);
            }
            for($j=0; $j<=count($request->vehicle_id)-1;$j++){
                $outload->vehicledetails()->attach($outload->id, ['vehicle_id'=> $request->vehicle_id[$j]]);
            }

            return redirect()->route('outloads')->with("success","Out Load is created successfully.");
        }else{
            return redirect()->route('outloads')->with("error","Out Load is not created due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutLoad  $outLoad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outload = OutLoad::find($id);
        $outload->articledetails()->detach();
        $outload->vehicledetails()->detach();
        if($outload->delete()){
            return redirect()->route('outloads')->with("success","Out Load is deleted successfully.");
        }else{
            return redirect()->route('outloads')->with("error","Out Load is not deleted due to some reason.");
        }
    }

    public function getVehicles($vendor_pool_id){

        $vehicles = Vehicle::where('vendor_pool_id', $vendor_pool_id)->get();
        return $vehicles;

    }
}
