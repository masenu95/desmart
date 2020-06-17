<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Auth;
use App\Comment;
use App\Reaction;
use App\Trend;
use App\User;
use Laravel\Ui\Presets\React;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $Comment=Comment::create([
            'post_id'=>$request['post_id'],
            'description'=>$request['comments'],
            'user_id'=>Auth::user()->id,
        ]);
        return back()->withInput()->with('sucess','comment sucessful created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $post_id=$request->postId;

        $these=['post_id'=> $post_id,'status'=>1];
        $like =Reaction::where($these)->count();

        $these=['post_id'=> $post_id,'status'=>0];
        $dislike=Reaction::where($these)->count();

        return response()->json(['like'=>$like,'dislike'=>$dislike]);


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

    public function like(Request $request)
    {
        //
        $post_id=$request->postId;


        $reaction_count=Reaction::where('user_id',Auth::user()->id)->count();
        if($reaction_count > 0){
            $post_reaction=Reaction::where('user_id',Auth::user()->id)->first();

            if($post_reaction->status==0){
                $post_reaction->update([
                    'status'=>1
                ]);
                return response()->json(['success'=>'like']);
            } elseif($post_reaction->status==1){
               if($post_reaction->delete()){
                $Trend=Trend::where('post_id',$post_id)->first();
                $num = intval($Trend->engaged);
                $num = $num -1;
                $Trend->update([
                    'engaged' => $num
                ]);
                return response()->json(['success'=>'unlike']);
               }
            }
        }
        else{
            $reaction=Reaction::create([
                'user_id'=>Auth::user()->id,
                'post_id'=>$post_id,
                'status'=>1,
            ]);

        if($reaction){
                $Trend=Trend::where('post_id',$post_id)->first();
                if($Trend){
                    $num = intval($Trend->engaged);
                    $num = $num +1;
                    $Trend->update([
                        'engaged' => $num
                    ]);
                } else{
                    $Trend=Trend::create([
                        'post_id' => $post_id,
                        'engaged' => 1
                    ]);
                }

        }
            return response()->json(['success'=>'like']);
        }


    }

    public function dislike(Request $request)
    {
        //
        $post_id=$request->postId;


        $reaction_count=Reaction::where('user_id',Auth::user()->id)->count();
        if($reaction_count > 0){
            $post_reaction=Reaction::where('user_id',Auth::user()->id)->first();

            if($post_reaction->status==1){
                $post_reaction->update([
                    'status'=>0
                ]);
                return response()->json(['success'=>'dislike']);
            } elseif($post_reaction->status==0){
                if($post_reaction->delete()){
                    $Trend=Trend::where('post_id',$post_id)->first();
                    $num = intval($Trend->engaged);
                    $num = $num -1;
                    $Trend->update([
                        'engaged' => $num
                    ]);
                }
                return response()->json(['success'=>'undislike']);
            }
        }
        else{
            $reaction=Reaction::create([
                'user_id'=>Auth::user()->id,
                'post_id'=>$post_id,
                'status'=>0,
            ]);
            if($reaction){
                $Trend=Trend::where('post_id',$post_id)->first();
                if($Trend){
                    $num = intval($Trend->engaged);
                    $num = $num +1;
                    $Trend->update([
                        'engaged' => $num
                    ]);
                } else{
                    $Trend=Trend::create([
                        'post_id' => $post_id,
                        'engaged' => 1
                    ]);
                }

        }

            return response()->json(['success'=>'dislike']);
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
        //
    }

    public function post(Request $request)
    {
        //

        if($request->action == 'get'){
            $post_id = $request->postId;
            $post = Post::where('id',$post_id)->first();
            if($post->pinned == 0){
                return response()->json(['success'=>'unpin']);
            }elseif($post->pinned == 1){
                return response()->json(['success'=>'pin']);
            }
        }else{
                $post_id = $request->postId;
                $post = Post::where('id',$post_id)->first();
                if($post->pinned == 0){
                $post->update([
                        'pinned'=>1
                ]);
                return response()->json(['success'=>'pin']);

                } elseif($post->pinned == 1){
                    $post->update([
                        'pinned'=>0
                ]);
                return response()->json(['success'=>'unpin']);
                }
        }
    }


    public function search(Request $request)
    {
        //
        $post_no=Post::all()->count();
        $user_count=User::all()->count();
        $categories=Category::all();

        $q=$request['search'];
        $result=Post::where('title','LIKE','%'.$q.'%')->orWhere('description','LIKE','%'.$q.'%')->get();
        if(count($result)>0){
            $result=$result;
               }else{
            $result=[];
            $result='No Details found. Try to search again !';
        }

        return view('forum.result',['results'=>$result,'user_count'=>$user_count,'post_no'=>$post_no,'categories'=>$categories]);


    }
}
