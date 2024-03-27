<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Region;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use App\Notifications\CommentNotification;
use Cloudinary;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index(Post $post){
        return view('posts/index')->with(['posts'=>$post->getPaginateByLimit(5), 'post_body'=>$post->mb_wordwrap($post->body, 21, '<br/>', true)]);
    }
    public function show(Post $post){
        
        return view('posts/show')->with(['post'=>$post])->with(['comments'=>$post->getPaginateComment(5)]);
        
    }
    public function create(Region $regions, Category $categories){
        return view('posts/create')->with(['regions'=>$regions->get(), 'categories'=>$categories->get()]);
    }
    public function store(PostRequest $request, Post $post){
        
        $input=$request['post'];
        $input_user=Auth::user()->id;
        $input +=['user_id'=>$input_user];
        $post->fill($input)->save();
        if($request->has('image')){
            $images=$request->file('image');
            foreach($images as $imagefile){
                $image = new Image();
                $image_url=Cloudinary::upload($imagefile->getRealPath())->getSecurePath();
                $image->image_url=$image_url;
                $image->post_id=$post->id;
                $image->save();
            }
            
        }
            $input_categories=$request->categories_array;
            $post->categories()->attach($input_categories);
            return redirect()->route('index');
        
    }
    public function edit(Post $post, Region $regions, Category $categories)
    {
        return view('posts.edit')->with(['post'=>$post])->with(['regions'=>$regions->get()])->with(['categories'=>$categories->get()]);
    }
    
    public function Update(PostRequest $request, Post $post){
        if($request->has('image')){
            $images=$request->file('image');
            foreach($images as $imagefile){
                $image = new Image();
                $image_url=Cloudinary::upload($imagefile->getRealPath())->getSecurePath();
                $image->image_url=$image_url;
                $image->post_id=$post->id;
                $image->save();
                }
            $input_categories=$request->categories_array;
            $post->categories()->sync($input_categories);
        }
        else{
            $input_categories=$request->categories_array;
            $post->categories()->sync($input_categories);
            
        }
        $input=$request['post'];
        $post->fill($input)->save();
        if($post->status === 2){
            return redirect()->route('index');
        }else{
            return redirect()->route('draft');
        }
              
    }
        

    public function imageDelete(Request $request, Image $image, Post $post){
        $deleteImages=$request->delete_array;
        foreach($deleteImages as $deleteImage){
            $image_null=$image->where('id','=',$deleteImage);
            $image_null->delete();
        }
        return redirect()->route('edit', ['post'=>$post->id]);
    }
    public function delete(Post $post){
        $post->delete();
        return redirect('/');
    }
    public function like(Request $request, Post $post, Like $like){
        $input_post=$post->id;
        $input_user=Auth::user()->id;
        $like->user_id=$input_user;
        $like->post_id=$input_post;
        $like->save();
        $request->session()->flash('like', 'いいねしました');
        return redirect()->back();
    }
    public function unlike(Request $request, Post $post){
        $like=Like::where('post_id', '=', $post->id)->where('user_id', '=', Auth::user()->id);
        $like->delete();
        $request->session()->flash('unlike', 'いいねを外しました');
        return redirect()->back();
    }
    public function search(Region $regions, Category $categories){
        return view('posts.search')->with(['regions'=>$regions->get(), 'categories'=>$categories->get()]);
    }
    public function read(CommentNotification $notification){
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }
    public function draft(Post $posts){
        return view('posts.draft')->with(['posts'=>$posts->getPaginateByDraft(5)]);
    }
    public function draftEdit(Post $post, Region $regions, Category $categories){
        return view('posts.draftedit')->with(['post' => $post, 'regions'=>$regions->get(), 'categories'=>$categories->get()]);
    }
    public function draftUpdate(PostRequest $request, Post $post, Region $regions, Category $categories){
        if($request->has('image')){
            $images=$request->file('image');
            foreach($images as $imagefile){
                $image = new Image();
                $image_url=Cloudinary::upload($imagefile->getRealPath())->getSecurePath();
                $image->image_url=$image_url;
                $image->post_id=$post->id;
                $image->save();
            }
            $input_categories=$request->categories_array;
            $post->categories()->sync($input_categories);
        }
        else{
            $input_categories=$request->categories_array;
            $post->categories()->sync($input_categories);
            
        }
        $input=$request['post'];
        $post->fill($input)->save();
        if($post->status === 2){
            return redirect()->route('index');
        }else{
            return redirect()->route('draft');
        }
        

              
    }
    
    
     function searchIndex(Request $request){
        $posts= Post::paginate(40);
        $search= $request->input('search');
        $query= Post::query();
        $input_region=$request->has('post_region');
        $input_category=$request->has('post_category');
        $spaceConversion = mb_convert_kana($search, 's');
        $wordArraysearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            if($input_region && $input_category && $search){
                $category_id=$request->input('post_category');
                $query->whereHas('categories', function($q) use($category_id){
                $q->where('id', '=', $category_id);
                });
                foreach($wordArraysearched as $value){
                    $query->where('body', 'like', '%'.$value.'%');
                    }
                $region_id = $request->input('post_region');
                $query->where('region_id', '=', $region_id);
                $query->where('status','=',2);
                $posts=$query->paginate(5);
                if($posts->isEmpty()){
                    session()->flash('success', '検索対象が見つかりませんでした');
                    return redirect("/post/search");
                    
                }else{
                    return view('searchs.index')->with(['posts'=>$posts]);
                }
            }elseif($input_category && $search){
                $category_id=$request->input('post_category');
                $query->whereHas('categories', function($q) use($category_id){
                    $q->where('id', '=', $category_id);
                });
                foreach($wordArraysearched as $value){
                    $query->where('body', 'like', '%'.$value.'%');
                    }
                $query->where('status','=',2);
                $posts=$query->paginate(5);
                 if($posts->isEmpty()){
                    session()->flash('success', '検索対象が見つかりませんでした');
                    return redirect("/post/search");
                    
                }else{
                    return view('searchs.index')->with(['posts'=>$posts]);
                }
            }elseif($input_region && $search){
                $region_id = $request->input('post_region');
                $query->where('region_id', '=', $region_id);
                foreach($wordArraysearched as $value){
                    $query->where('body', 'like', '%'.$value.'%');
                    }
                $query->where('status','=',2);
                $posts=$query->paginate(5);
                    if($posts->isEmpty()){
                        session()->flash('success', '検索対象が見つかりませんでした');
                        return redirect("/post/search");
                    }else{
                        return view('searchs.index')->with(['posts'=>$posts]);
                    }
            }else{
                foreach($wordArraysearched as $value){
                $query->where('body', 'like', '%'.$value.'%');
                    }
                $query->where('status','=',2);
                $posts=$query->paginate(5);
                 if($posts->isEmpty()){
                    session()->flash('success', '検索対象が見つかりませんでした');
                    return redirect("/post/search");
                }else{
                    return view('searchs.index')->with(['posts'=>$posts]);
                }
            }
    }
}


                
      
        
        
    

    

