<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Categories',
        ];
        $categories = Category::all();
        return view('categories.manage',compact('pageData','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required|min:3|max:255'
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $categories = new Category();
        $categories->name = $request->name;
        $categories->save();

        if($categories){
            return redirect()->route('categories')->with("success","Category is created.");
        }else{
            return redirect()->route('categories')->with("error","Category is not created.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
        return $categories;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $categories = Category::find($request->id);
        $categories->name = $request->name;
        $categories->guard_name = 'web';
        $categories->save();
        if($categories){
            return redirect()->route('categories')->with("success","Category is Updated Successfully.");
        }else{
            return redirect()->route('categories')->with("error","Having problem while updated category.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::find($id);
        $categories->delete();
        return back()->with('warning','Category deleted successfully.');
    }
}
