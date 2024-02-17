<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller{
    
    
    
    public function store(Request $request, Comment $comment, Post $post){
        $input_comment=$request->input('comment');
        $input_post=$post->id;
        $input_user=Auth::user()->id;
        $comment->post_id=$input_post;
        $comment->user_id=$input_user;
        $comment->content=$input_comment;
        $comment->save();
        
        return redirect("/posts/$post->id");
    }
    
}