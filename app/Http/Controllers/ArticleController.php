<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => 'Articles',
        ];
        $articles = Article::all();

        return view('article.manage', compact('pageData','articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageData = [
            'pageTitle' => 'Add Article',
        ];
        $categories = Category::all();
        return view('article.add', compact('pageData' , 'categories'));
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
            'code' => 'required',
            'name' => 'required',
            'weight' => 'required',
        ]);

        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }

        $article = new Article();
        $article->category_id = $request->category_id;
        $article->code = $request->code;
        $article->name = $request->name;
        $article->weight = $request->weight;
        $article->created_by = auth()->user()->id;
        $article->save();

        if($article){
            return redirect()->route('articles')->with("success","Article is created successfully.");
        }else{
            return redirect()->route('articles')->with("error","Article is not created due to some reason.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $artical
     * @return \Illuminate\Http\Response
     */
    public function show(Artical $artical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $artical
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageData = [
            'pageTitle' => 'Edit Article',
        ];
        $article = Article::where('id',$id)->first();
        $categories = Category::all();
        return view('article.edit', compact('pageData', 'article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $artical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'weight' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $article = Article::find($id);
        $article->code = $request->code;
        $article->name = $request->name;
        $article->weight = $request->weight;
        $article->category_id = $request->category_id;
        $article->updated_by = auth()->user()->id;
        $article->update();

        if($article){
            return redirect()->route('articles')->with("success","Article is updated successfully.");
        }else{
            return redirect()->route('articles')->with("error","Article is not updated due to some reason.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $artical
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::where('id', $id)->delete();
        if($article){
            return redirect()->route('articles')->with("success","Article is deleted successfully.");
        }else{
            return redirect()->route('articles')->with("error","Article is not deleted due to some reason.");
        }
    }
}
