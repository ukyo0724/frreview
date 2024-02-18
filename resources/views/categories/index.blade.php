<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
       
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/posts.css')}}">
    </head>
    <x-app-layout>
    <x-slot name="header">
             {{ __('投稿一覧') }}
        </x-slot>
    <body>
        <div class="index-title">
            <h1>投稿一覧</h1>
        </div>
        <div class="container">
            <div class="posts-index">
             @foreach($posts as $post)
            <div class='post'>
                <a class="user" href='/users/{{$post->user_id}}'>{{$post->user->name}}</a>
                <h2 class='title'><a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
                <p class='body'>{{$post->body}}</p>
                @foreach($post->categories as $category)
                <a href="/categories/{{$category->id}}">{{ $category->name }}</a>
                @endforeach
                <a href="/regions/{{$post->region->id}}">{{ $post->region->name}}</a>
                <p class="city">{{$post->city}}</p> 
            </div>
            @endforeach
            </div>
        </div>
        <div class='paginate'>
            {{$posts->links()}}
        </div>
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <div class="create">
            <a href="/posts/create">create</a>
        </div>
        </div>
    </body>
    </x-app-layout>
</html>