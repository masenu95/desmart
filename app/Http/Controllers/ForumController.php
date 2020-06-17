<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Fcategory;
use App\Post;
Use App\Fimage;
use App\Reaction;
Use App\User;
use App\Trend;
use App\Message;


class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //category
         $categories=Fcategory::where('confirmed',1)->get();

         //Trending
         $trends = Trend::orderBy('engaged', 'desc')->limit(5)->get();
        //recent
        $recents=Post::orderBy('created_at', 'desc')->limit(5)->get();
        $post_no=Post::all()->count();
        $user_count=User::all()->count();
        $staffs=User::where('role_id',1)->orWhere('role_id',2)->get();
        return view('forum.index',['categories'=>$categories,'recents'=>$recents,'trends'=>$trends,'post_no'=>$post_no,'user_count'=>$user_count,'staffs'=>$staffs]);
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
        //get user input
        $post=Post::create([
            'fcategory_id'=>$request['category'],
            'title'=>$request['title'],
            'description'=>$request['description'],
            'pinned'=>0,
            'status'=>1,
            'user_id'=>Auth::user()->id
        ]);

        if($post){
            foreach($request->upload_file as $image){
                $photo = $image->store('public/post');
                $fimages=FImage::create([
                    'name'=>$photo,
                    'post_id'=>$post->id,
                ]);
            }

            return redirect()->action(
                'ForumController@post',['id' => $post->id]
            );
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
        //find all post
        $fcategory=Fcategory::where('id',$id)->first();
        $categories=Fcategory::where('confirmed',1)->get();

        //pinned thread
        $these=['fcategory_id'=>$id,'pinned'=>1];

        $posts['pinned']=Post::where($these)->orderBy('created_at', 'desc')->limit(8)->get();

        //normal
        $these=['fcategory_id'=>$id,'pinned'=>0];
        $posts['normal']=Post::where($these)->get();

        $post_no=Post::all()->count();
        $user_count=User::all()->count();
        return view('forum.show',['posts'=>$posts,'fcategory'=>$fcategory,'categories'=>$categories,'post_no'=>$post_no,'user_count'=>$user_count]);
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
    public function post($id){
        //show post
        $reaction=[];

        $post=Post::where('id',$id)->first();
        $post_count=Post::where('user_id',$post->user_id)->count();

        //count likes

        $these=['post_id'=>$id,'status'=>1];
        $reaction['likes']=Reaction::where($these)->count();
        unset($these);

        $these=['post_id'=>$id,'status'=>0];
        $reaction['dislike']=Reaction::where($these)->count();
        unset($these);

        //most message





        //count dislike

        //check current user reaction
        if(Auth::check()){
        $matchThese=['post_id'=>$id,'user_id'=>Auth::user()->id];
        $reaction['me']=Reaction::where($matchThese)->first();
        }else{
            $reaction['me'] = null;
        }

        $post_no=Post::all()->count();
        $categories=Fcategory::where('confirmed',1)->get();
        return view('post.index',
        ['post'=>$post,'post_no'=>$post_no,'categories'=>$categories,'post_count'=>$post_count,'reaction'=>$reaction]
    );

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
}
