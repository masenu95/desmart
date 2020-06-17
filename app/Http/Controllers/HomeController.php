<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\CheckAdmin;
use App\User;
use App\Post;
use App\Product;
use App\Subcategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     public function index(){
         $post=Post::count();
         $user=User::count();
         $subcategories=Subcategory::all();
         $product = Product::count();
         return view('home',['postCount'=>$post,'userCount'=>$user,'productCount'=>$product,'subcategories'=>$subcategories]);
     }

     public function users(){
        $users=User::orderBy('role_id', 'asc')->get();
        $i=0;
        return view('admin.users.index',['users'=>$users,'i'=>$i]);
    }

    public function admin(Request $request)
    {
        $user_id = $request->user;
        $update = User::where('id',$user_id)->first();
        if($update){
            if($request->roles=='admin'){
            $update->update([
                'role_id'=>1
            ]);
            return response()->json(['success'=>'admin']);
            }
            elseif($request->roles=='moderator'){
                    $update->update([
                        'role_id'=>2
                    ]);
                    return response()->json(['success'=>'moderator']);
            }
        }
    }
}
