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
            {{ __('投稿') }}
        </x-slot>
    <body>
        <h1>投稿</h1>
        <form action="/posts" method="POST" id="form_post" enctype="multipart/form-data">
            @csrf
        <div class="post-edit-container">
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{old('post.title')}}"/>
                <p class="title_error" style="color:red">{{$errors->first('post.title')}}</p>
                
            </div>
            <div class="body">
                <h2>投稿内容</h2>
                <textarea name="post[body]" placeholder="おすすめの場所はパリです">{{old('post.body')}}</textarea>
                <p class="title_error" style="color:red">{{$errors->first('post.body')}}</p>
            </div>
            <div class="city">
                <h2>都市名</h2>
                <input class='city-name' name="post[city]">
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
                <label for="input">画像ファイル</label>
                <input type="file" id='image1' name="image[]" multiple="multiple">
                <input type="file" name="image[]" id='image2' multiple="multiple">
                <figure id='figure' style="display:none">
                    <figcaption>画像のプレビューファイル</figcaption>
                    <img src="" alt="" id="figureimage" style="max-width: 100%">
                </figure>
            </div>
        </div>
        <button type="submit" name="save_draft" class="save_draft">下書き保存</button>
        <button type="submit" name="release" class="publish">公開</button>
        </form>
        
            
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
    
    
    </html>