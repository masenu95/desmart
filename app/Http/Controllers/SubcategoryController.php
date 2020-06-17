<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategory;
use App\Category;
use Auth;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subcategories=Subcategory::all();
        $i=0;
        return view('admin.subcategory.index',['subcategories'=>$subcategories,'i'=>$i]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category=Category::all();
        return view('admin.subcategory.new',['categories'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate=$request->validate([
            'name'=> 'required|unique:subcategories',
      
        ]);

        $subcategory=Subcategory::create([
            'name'=>$request['name'],
            'confirmed'=>0,
            'category_id'=>$request['category'],
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->route('Subcategory.index')->with('success','subcategory added');
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

    public function visibility(Request $request){
        //check for category
        $category=Subcategory::where('id',$request['category'])->first();
        if($request['action']=='visible'){
            $category->update([
                'confirmed'=>1
            ]);
            return response()->json(['success'=>'visible']);

        }else if($request['action']=='hidden'){
            $category->update([
                'confirmed'=>0
            ]);
            return response()->json(['success'=>'hide']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $subcategory=Subcategory::where('id',$id)->first();
        $categories=Category::all();
       
        return view('admin.subcategory.edit',['subcategory'=>$subcategory,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
          //check for category
          $validate=$request->validate([
            'name'=> 'required|unique:categories|min:3|max:12'
        ]);

        $subcategory = Subcategory::where('id',$id)->first();

        $subcategory->update([
            'name'=>$request['name'],
            'category_id'=>$request['category'],
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->route('Subcategory.index')->with('success','subcategory  updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
            //delete Product
            $findsubcategory=Subcategory::find($id);
            if($findsubcategory->delete()){
                return redirect()->route('Subcategory.index')->with('success','Product category deleted successfully');
            }
            return back()->withInput()->with('error','Product subcategory could not deleted try again');

       }

}
