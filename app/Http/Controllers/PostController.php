<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::when(request()->search,function ($q){
            $q->where('title','like','%'.request()->search.'%');

        })->with(['user','category'])->latest('id')->paginate(7);
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request->validate([

            'title'=>'required|min:3|unique:posts,title',
            'category'=>'required|exists:categories,id',
            'description'=>'required|min:10',
        ]);
        $post=new Post();
        $post->title=$request->title;
        $post->slug=Str::slug($request->title);
        $post->category_id=$request->category;
        $post->description=$request->description;
        $post->excerpt=Str::words($request->description,20);
        $post->user_id=Auth::id();
        $post->isPublish='1';
        $post->save();

        return redirect()->route('post.index')->with("status","success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validate([

            'title'=>'required|min:3|unique:posts,title',
            'category'=>'required|exists:categories,id',
            'description'=>'required|min:10',
        ]);

        $post->title=$request->title;
        $post->slug=Str::slug($request->title);
        $post->category_id=$request->category;
        $post->description=$request->description;
        $post->excerpt=Str::words($request->description,20);
        $post->user_id=Auth::id();
        $post->isPublish='1';
        $post->update();

        return redirect()->route('post.index')->with("status","success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
