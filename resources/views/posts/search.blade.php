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
    <body>
        <form metho="GET" action="{{route('search.index')}}">
             <input type="search" placeholder="キーワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
             <div class="region">
                <h2>地域</h2>
                <select name="post.region">
                    @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                    @endforeach
                </select>
             </div>
             <div class="category">
                <h2>カテゴリー</h2>
                <select name="post.category">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
             <div>
                <button type="submit">検索</button>
                <button></button>
                 <a href="{{ route('post.search') }}" class="text-white">
                クリア
                 </a>
                </button>
             </div>
        </form>
        
    </body>