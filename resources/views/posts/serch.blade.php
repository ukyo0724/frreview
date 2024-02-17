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
        <form metho="GET" action="{{route('serch.index')}}">
             <input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
             <div>
                <button type="submit">検索</button>
                <button></button>
                 <a href="{{ route('serch.index') }}" class="text-white">
                クリア
                 </a>
                </button>
             </div>
        </form>
        
    </body>