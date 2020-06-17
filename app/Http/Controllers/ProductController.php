<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Category;
Use App\Subcategory;
Use App\Image;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show',]);

    }

    public function index()
    {
        //
        $categories=Category::all();
        $products=Product::all();
        return view('Products',['products'=>$products,'categories'=>$categories]);
    }

    public function subcategory($id)
    {
        $categories=Category::all();
        $products=Product::where("subcategory_id",$id)->get();
        return view('Products',['products'=>$products,'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Category detail

            $categories=Category::all();
            return view('Product.new',['categories'=>$categories]);


    }

    public function getsubcategory($id)
    {
        $subcategory = Subcategory::where("category_id",$id)->pluck("name","id");
        return json_encode($subcategory);
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


        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:6',
            'subcategory' =>'required|numeric',
            'location' => 'required',
            'price' => 'required|numeric|min:3',
        ]);
        foreach($request->upload_file as $image){
            $validatedData=$request->validate([
                'image' => 'mimes:jpeg,bmp,png,jpg',
            ]);
        }

        $product=Product::create([
            'title'=>$request['title'],
            'description'=>$request['description'],
            'subcategory_id'=>$request['subcategory'],
            'location'=>$request['location'],
            'status'=>1,
            'price'=>$request['price'],
            'user_id'=>Auth::user()->id,
        ]);

        if($product){
            foreach($request->upload_file as $image){
                $photo = $image->store('public/product');
                $images=Image::create([
                    'name'=>$photo,
                    'product_id'=>$product->id,
                ]);
            }

            return redirect()->action(
                'ProductController@show',['id' => $product->id]
            );
        }
        else{

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
        //show product

        $product=Product::where('id',$id)->first();
        $categories=Category::all();

            if($product){
            return view('Product.show',['product'=>$product,'categories'=>$categories]);
            }
            else{
                return redirect()->route('Product.index')->with('error','Product not found');
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
        //check if your owner or admin
        $product=Product::where('id',$id)->first();
        $categories=Category::all();
        if(Auth::user()->id==$product->user->id || Auth::user()->role==1){
            return view('Product.edit',['product'=>$product,'categories'=>$categories]);
        } else{
             return redirect()->back()->with('error','You can not perform this action');
        }
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //delete Product
         $findProduct=Product::find($id);
         foreach($findProduct->images as $image){
            Storage::delete($image->name);
         }
         if($findProduct->delete()){
             return redirect()->route('Product.index')->with('success','Product deleted successfully');
         }
         return back()->withInput()->with('error','Product could not deleted try again');

    }
}
