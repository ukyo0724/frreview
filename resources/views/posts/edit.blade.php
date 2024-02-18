<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/posts.css')}}">
        <script src="{{asset('js/postbtn.js')}}"></script>
    </head>
    <x-app-layout>
        <x-slot name="header">
            {{ __('編集') }}
        </x-slot>
    <body>
        <h2>編集画面</h2>
        <form action="/posts/update/{{$post->id}}" method="POST"  id="form_edit_{{$post->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="post-edit-container">
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="post[title]"  value="{{$post->title}}"/>
                <p class="title_error" style="color:red">{{$errors->first('post.title')}}</p>"
                
            </div>
            <div class="body">
                <h2>投稿内容</h2>
                <textarea name="post[body]" >{{$post->body}}</textarea>
                <p class="title_error" style="color:red">{{$errors->first('post.body')}}</p>"
            </div>
            <div class="city">
                <h2>都市名</h2>
                <input class='city-name' name="post[city]">
                <p class="title_error" style="color:red">{{$errors->first('post.body')}}</p>"
            </div>
            <div class="region">
                <h2>地域</h2>
                <select name="post[region_id]">
                    @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                    @endforeach
                </select>
            </div>
                
            <div class="category">
                <h2>カテゴリー</h2>
                @foreach($categories as $category)
                <label>
                    <input type="checkbox" value="{{$category->id}}" name="categories_array[]">
                    {{$category->name}}
                    </input>
                </label>
                @endforeach
            </div>
            <div class="image">
                <input type="file" name="image">
            </div>
        </div>
            <button type="button" onclick="editPost({{$post->id}})">投稿</button>
        </form>
        <form action="/posts/image/delete/{{$post->id}}" method="post">
                    @csrf
                    @method("DELETE")
                <button type="submit" name="image_delete">削除</button>
                </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
       
    </body>
    </x-app-layout>
    </html>