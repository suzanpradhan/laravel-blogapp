<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'], ["except" => ["index", "show"]]);
    }

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
            "body"=>"required",
            "cover_image"=>"image|nullable|max:1999"
        ]);

        // $post = [  "title"  =>  $request->title,
        //             "body" => $request->body
        //         ];
       
        // $post  =  Post::create($post);

        // Handling File Upload
        if ($request->hasFile("cover_image")) {
            // get file name with extension
            $fileNameWithExt = $request->file("cover_image")->getClientOriginalName();
            // get filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get extension
            $extension = $request->file("cover_image")->getClientOriginalExtension();
            // get file to store
            $fileToStore = $filename."_".time().".".$extension;
            //upload image
            $path = $request->file("cover_image")->storeAs("public/cover_images",$fileToStore);
        }else {
            $fileToStore = "noimage.png";
        }

        // Saving the Post into DB.
        $post = new Post;
        $post->title = $request->input("title");
        $post->body = $request->input("body");
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileToStore;
        $post->save();

        // Redirects to posts index page with success message.
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
        $post = Post::find($id);
        // checking for correct post user
        if (auth()->user()->id !== $post->user_id){
            return redirect("/posts")->with("error", "Unauthorized User.");
        }
        return view("posts.editPage")->with("post",$post);
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
        $request->validate( 
            [
                "title"=> "required",
                "body"=>"required"
            ]);
        $post = Post::find($id);

        if (auth()->user()->id !== $post->user_id){
            return redirect("/posts")->with("error", "Unauthorized User");
        }else {
            if ($request->hasFile("cover_image")) {
                // get file name with extension
                $fileNameWithExt = $request->file("cover_image")->getClientOriginalName();
                // get filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // get extension
                $extension = $request->file("cover_image")->getClientOriginalExtension();
                // get file to store
                $fileToStore = $filename."_".time().".".$extension;
                //upload image
                $path = $request->file("cover_image")->storeAs("public/cover_images",$fileToStore);
            }
            $post->title = $request->input("title");
            $post->body = $request->input("body");
            if ($request->hasFile("cover_image") && $post->cover_image != "noimage.png") {
                Storage::delete("public/cover_images/".$post->cover_image);
                $post->cover_image = $fileToStore;
            }
            $post->save();
            return redirect("/posts")->with("success", "Post Updated!");
        }

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
        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id) {
            return redirerct("/posts")->with("error", "Unauthorized User");
        }
        if ($post->cover_image != "noimage.png") {
            Storage::delete("public/cover_images/".$post->cover_image);
        }
        $post->delete();
        return redirect("/posts")->with("success", "Post Deleted");
        //
    }
}
