<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return json
        // return Post::all();
        //return index Page
        $posts = Post::orderBy("created_at", "desc")->take(100)->paginate(2);
        // Post::where("title", "Post One")->get();
        // DB::select("SELECT * FROM posts");
        return view("posts.index")->with("posts", $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.createPost");
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
        $request->validate( 
        [
            "title"=> "required",
            "body"=>"required"
        ]);

        // $post = [  "title"  =>  $request->title,
        //             "body" => $request->body
        //         ];
       
        // $post  =  Post::create($post);

        $post = new Post;
        $post->title = $request->input("title");
        $post->body = $request->input("body");
        $post->save();
            // back()
        return redirect("/posts")->with("success", "Post Created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $eachPost = Post::find($id);
        return view("posts.postPage")->with("eachPost", $eachPost);
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
