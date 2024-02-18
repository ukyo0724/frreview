<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/posts.css')}}">
         <script src="{{asset('js/postbtn.js')}}"></script>
    </head>
    <x-app-layout>
        <x-slot name="header">
            {{ __('投稿詳細') }}
        </x-slot>
    <body>
        <div class="container">
            <div class='post'>
                <h2 class='title'><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                <p class='show user'>{{$post->user->name}}</p>
                <p class='body'>{{$post->body}}</p>
                <a href="/regions/{{$post->region->id}}">{{ $post->region->name}}</a>
                <p class="city">{{$post->city}}</p>
                @foreach($post->categories as $category)
                <a href="/categories/{{$category->id}}">{{ $category->name }}</a>
                @endforeach
                @foreach($post->images as $image)
                @if($image->image_url)
                <img src="{{$image->image_url}}" alt="画像が読み込めません"/>
                @endif
                @endforeach
            </div>
        </div>
        <form action="/posts/delete/{{$post->id}}" id="form_{{ $post->id }}" method="post">
            @csrf
            @method("DELETE")
            <button type="button" onclick="deletePost({{$post->id}})">delete</button>
        </form>
        <div class="container-comment">
            <p class="comment-header">コメント</p>
            <form action="/comments/store/{{$post->id}}" method="POST" id="form_comment_{{$post->id}}">
                @csrf
            <textarea class="comment-post" placeholder="コメントを入力してください" name="comment">{{old('comment.content')}}</textarea>
            <p class="title_error" style="color:red">{{$errors->first('comment')}}
            <button type="button" onclick="addComment({{$post->id}})">コメント投稿</button>
            </form>
            @foreach($comments as $comment)
            <div class="comment-display">
                <p class="comment-content">{{$comment->content}}</p>
            </div>
            @endforeach
        </div>
        <div class="paginate">
            {{$comments->links()}}
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <div class="edit">
            <div class="edit_go">
                <a href="/posts/edit/{{$post->id}}">edit</a>
            </div>
        </div>
    </body>
    </x-app-layout>
    
    </html>