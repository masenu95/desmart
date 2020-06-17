<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::get();
        $i=0;
        return view('admin.category.index',['categories'=>$categories,'i'=>$i]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
       
        return view('admin.category.new');

   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $validate=$request->validate([
            'name'=> 'required|unique:categories|min:3|max:12'
        ]);


        $category=Category::create([
            'name'=>$request['name'],
            'confirmed'=>0,
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->route('Category.index')->with('success','forum category added');
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
        //
        $category=Category::where('id',$id)->first();
       
        return view('admin.category.edit',['category'=>$category]);
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

        //check for category
        $validate=$request->validate([
            'name'=> 'required|unique:categories|min:3|max:12'
        ]);

        $category = Category::where('id',$id)->first();

        $category->update([
            'name'=>$request['name'],
            'user_id'=>Auth::user()->id,
        ]);

      

        return redirect()->route('Category.index')->with('success','category  updated');
        

    }

    public function visibility(Request $request){
        //check for category
        $category=Category::where('id',$request['category'])->first();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  
                //delete Category
                $findcategory=Category::find($id);
               foreach($findcategory->subcategories as $subcategory){
                   $subcategory->delete();
                }
                    if($findcategory->delete()){
                        return redirect()->route('Category.index')->with('success','Category deleted successfully');
                    }else{
                    return back()->withInput()->with('error','Category could not deleted try again');
                    }
               
              
    }
}
