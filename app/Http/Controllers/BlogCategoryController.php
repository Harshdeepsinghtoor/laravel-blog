<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catogories=BlogCategory::all();
        return view('category.index', [
            'cats' => $catogories,
        ]); 
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('category.createcategory');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateds = $request->validate([
            'catname' => 'required|unique:blog_categories|min:2',
        ]);
        $newcat = BlogCategory::create([
            'catname' => $request->catname,
        ]);

        return redirect('/category')->with('category', 'New Category is Created Successfully !');       
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('category.edit',['category'=>$blogCategory]) ; 
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        
        $blogCategory->update([
            'catname' => $request->catname,         
        ]);

        return redirect('/category')->with('message', 'Blog Updated Successfully');    
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete(); 

        return redirect('/category')->with('deletemesg', 'The Category is Deleted Successfully');           
        echo "Blog deleted successfully" ;
        //
    }
}
