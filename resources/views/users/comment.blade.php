<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/posts.css')}}">
    </head>
    <body>
        @foreach
        <div class="container">
            <div class='post'>
                <h2 class='title'><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                <p class='comment user'>{{$post->user->name}}</p>
                <p class='body'>{{$post->body}}</p>
                <a href="/regions/{{$post->region->id}}">{{ $post->region->name}}</a>
                <p class="city">{{$post->city}}</p>
                @foreach($post->categories as $category)
                <a href="/categories/{{$category->id}}">{{ $category->name }}</a>
                @endforeach
                <img src="{{post->image_url}}" alt="画像が読み込めません"/>
            </div>
        </div>
        <form action="/posts/{{$post->id}}/delete" id="form_{{ $post->id }}" method="post">
            @csrf
            @method("DELETE")
            <button type="button" onclick="deletePost({{$post->id}})">delete</button>
        </form>
        <div class="container-comment">
            <p class="comment-header">コメント</p>
            <form action="/comment/{{post->id}}" method="post" id="form_comment_{{$post->id}}">
                @csrf
            <textarea class="comment-post" placeholder="コメントを入力してください" name="comment[content]">{{old('comment.content'}}</textarea>
            <p class="title_error" style="color:red">{{$errors->first('comment.content')}}
            <button type="button" onclick="addcomment({{$post->id}})"></button>
            </form>
            @foreach($post->comments as $comment)
            <div class="comment-display">
                <p class="comment-content">{{$comment->content}}</p>
            </div>
            @endforeach
        </div>
        <div class="paginate">
            {{$post->comments()->links()}}
        </div>
        @endforeach
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <div class="edit">
            <div class="edit_go">
                <a href="/posts/{{$post->id}}/edit">edit</a>
            </div>
        </div>
    </body>
    </x-app-layout>
    </html>