<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Notifications\CommentNotification;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller{
    
    
    
    public function store(CommentRequest $request, Comment $comment, Post $post){
        $input_comment=$request->input('comment');
        $input_post=$post->id;
        $input_user=Auth::user()->id;
        $comment->post_id=$input_post;
        $comment->user_id=$input_user;
        $comment->content=$input_comment;
        $comment->save();
        $user_id=$post->user->id;
        $user=User::find($user_id);
        return redirect()->back();
    }
    public function commentLike(Request $request, Comment $comment, Like $like){
        $input_comment=$comment->id;
        $input_user=Auth::user()->id;
        $like->user_id=$input_user;
        $like->comment_id=$input_comment;
        $like->save();
        $request->session()->flash('commentlike', '投稿に対するコメントにいいねしました');
        return redirect()->back();
    }
    public function commentUnlike(Request $request, Comment $comment){
        $like=Like::where('comment_id', '=', $comment->id)->where('user_id', '=', Auth::user()->id);
        $like->delete();
        $request->session()->flash('commentunlike', '投稿に対するコメントのいいねを外しました');
        return redirect()->back();
    }
    
}