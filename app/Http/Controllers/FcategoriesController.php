<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Fcategory;
class FcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function index()
    {
        //all forums
        $Fcategories=Fcategory::all();
        $i=1;
      
            return view('admin.fcategory.index',['fcategories'=>$Fcategories,'i'=>$i]);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.fcategory.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=> 'required|unique:fcategories',
            'caption'=>'required',
      
        ]);
        //get user input
        $fcategory=Fcategory::create([
            'name'=>$request['name'],
            'caption'=>$request['caption'],
            'user_id'=>Auth::user()->id,
            'confirmed'=>0,
        ]);
         return redirect()->route('Fcategory.index')->with('success', $fcategory->name.' is added in smart inverstors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function visibility(Request $request){
        //check for category
        $fcategory=Fcategory::where('id',$request['category'])->first();
        if($request['action']=='visible'){
            $fcategory->update([
                'confirmed'=>1
            ]);
            return response()->json(['success'=>'visible']);

        }else if($request['action']=='hidden'){
            $fcategory->update([
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
         $fcategory=Fcategory::where('id',$id)->first();
         return view('admin.Fcategory.edit',['fcategory'=>$fcategory]);
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
    

        $fcategory = Fcategory::where('id',$id)->first();

        $fcategory->update([
            'name'=>$request['name'],
            'caption'=>$request['caption'],
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->route('Fcategory.index')->with('success','fcategory updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete
        $fcategory=Fcategory::find($id);
        if($fcategory->delete()){
            return redirect()->route('Fcategory.index')->with('success','category sucessful deleted');
        }
            return back()->withInput()->with('error','category sucessful deleted');
    }

    public function hide($id){


        //find forum category
        $fcategory=Fcategory::where('id',$id)->first();
        if($fcategory->confirmed==0){
           $fcategory->update([
               'confirmed'=>1
           ]);

          if($fcategory){
              return redirect()->route('Fcategory.index')->with('success',$fcategory->name.' is now visible on smart investors');
          }
        }elseif($fcategory->confirmed==1){

            $fcategory->update([
                'confirmed'=>0
            ]);

           if($fcategory){
               return redirect()->route('Fcategory.index')->with('success',$fcategory->name.' is hidden on smart investors');
           }
        }
    }
}
