<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Region;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Cloudinary;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index(Post $post){
        return view('posts/index')->with(['posts'=>$post->getPaginateByLimit(1)]);
    }
    public function show(Post $post){
        
        return view('posts/show')->with(['post'=>$post])->with(['comments'=>$post->getPaginateComment(1)]);
        
    }
    public function create(Region $regions, Category $categories){
        return view('posts/create')->with(['regions'=>$regions->get(), 'categories'=>$categories->get()]);
    }
    public function store(PostRequest $request, Post $post, Image $image){
        
        $image_url=Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input=$request['post'];
        $input_user=Auth::user()->id;
        $input +=['user_id'=>$input_user];
        if($request->has('save_draft')){
            $input_status=1;
            $input += ['status'=>$input_status];
        }else{
            $input_status=2;
             $input +=['status'=>$input_status];
        }
        $post->fill($input)->save();
        $image->image_url=$image_url;
        $image->post_id=$post->id;
        $image->save();
        $input_categories=$request->categories_array;
        $post->categories()->attach($input_categories);
        return redirect("/posts/$post->id");
    }
    public function edit(Post $post, Region $regions, Category $categories)
    {
       
        return view('posts.edit')->with(['post' => $post, 'regions'=>$regions->get(), 'categories'=>$categories->get()]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
    $input_post = $request['post'];
    $post->fill($input_post)->save();

    return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post){
        $post->delete();
        return redirect('/');
    }
    public function like(Request $request, Post $post, Like $like){
        $input_post=$post->id;
        $input_user=Auth::user()->id;
        $like->user_id=$input_user;
        $like->post_id=$input_user;
        $like->save();
        session()->flash('succes', 'いいねしました');
        return redirect()->back();
    }
    public function unlike(Request $request, Post $post){
        $like=Like::where('post_id', '=', $post->id)->where('user_id', '=', Auth::user()->id);
        $like->delete();
        session()->flash('success', 'You Unliked the Reply.');
        return redirect()->back();
    }

    
}
