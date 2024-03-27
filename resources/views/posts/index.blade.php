<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/posts.css')}}">
    </head>
    <x-app-layout>
        <x-slot name="header">
            {{ __('投稿一覧') }}
        </x-slot>
    <body>
        @if (session('like'))
            <div class="flex p-2 bg-blue-200 text-blue-800 p-4 text-sm rounded border border-blue-300 my-3">
                <div class="flex-shrink mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-grow">{{ session('like') }}</div>
            </div>
        @endif
        @if(session('unlike'))
            <div class="flex p-2 bg-yellow-200 text-yellow-800 p-4 text-sm rounded border border-yellow-300 my-3">
                <div class="flex-shrink mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-grow">{{ session('unlike') }}</div>
            </div>
        @endif
    
                
        <div class="notifications">
        @forelse(Auth::user()->notifications()->get() as $notification)
            <div class="{{ is_null($notification->read_at) ? 'un-read' : '' }}">
                <p>{{ $notification->data['date'] }}</p>
                <p>{{ $notification->data['comment_id'] }}</p>
                <p>{{ $notification->data['user_id'] }}</p>
                <a href="{{$notification->data['url']}}">リンク</a>
                <form action="{{route('read', ['notification'=> $notification->data['comment_id']])}}" method='POST'>
                <button type="submit" class="notification">送信</button>
                </form>
            </div>
        @empty
            <p>まだ通知はありません</p>
        @endforelse
        </div>
            <div class="posts-index lg:w-screen">
             @foreach($posts as $post)
                <div class="post lg:w-screen">
                    <section class="text-gray-600 body-font lg:w-screen">
  　　　                   <div class="container px-5 py-24 mx-auto ">
   　　　                      <div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mb-10 border-gray-200 sm:flex-row flex-col">
                                <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 flex-shrink-0">
                                @if($post->user->image_user)
                                    <img src="{{$post->user->image_user}}" class="h-full w-full rounded-full object-cover object-center sm:w-32 sm:h-32 h-20 w-20">
                                @else
                                    <img src="{{asset('images/paris.jpg')}}" class="h-full w-full rounded-full object-cover object-center sm:w-32 sm:h-32 h-20 w-20"> 
                                @endif
                                </div>
                                <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                                    <a class="user" href='/users/{{$post->user_id}}'>ユーザー：{{$post->user->name}}</a><br>
                                    <p　class="text-gray-900 text-lg title-font font-medium mb-2">タイトル：{{$post->title}}</p>
                                    <p class="title-font font-medium mb-2">都市名：{{$post->city}}</p> 
                                    <p class="body leading-relaxed text-base">{{$post->body}}</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="rounded-full bg-primary-50 py-1 pr-3 text-sm font-semibold text-yellow-600"><a href="/regions/{{$post->region->id}}">{{ $post->region->name}}</a></span>
                                        <span class="rounded-full bg-green-50 py-1 text-sm font-semibold text-green-600">
                                        @foreach($post->categories as $category)
                                            <a  href="/categories/{{$category->id}}">{{ $category->name }}</a>
                                            </span>
                                        @endforeach
                                    </div>
                                    <div class="like leading-relaxed text-base">
                                    @if($post->is_liked_by_auth_user())
                                        <form action="{{ route('post.unlike', ['post'=>$post->id])}}" method="POST">
                                        @csrf
                                        <button type=submit class="btn btn-success btn-sm flex flex-row gap-1">
                                            <svg width="18px" height="18px" fill="red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 440"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                            </svg>
                                            <span class="budge text-base">{{$post->likes->count() }}</span>
                                        </button>
                                        </form>
                                    @else
                                        <form action="/likes/{{$post->id}}" method="POST">
                                        @csrf
                                        <button type=submit class="btn btn-success btn-sm flex flex-row gap-1">
                                        <svg width="18px" height="18px" fill="#111827" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 440"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                             <path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/>
                                        </svg>
                                        <span class="budge text-base">{{$post->likes->count() }}</span>
                                        </button>
                                        </form>
                                     @endif
                                    </div>
                                    <a href="{{route('show', ['post'=>$post->id])}}" class="mt-3 text-indigo-500 inline-flex items-center">詳細
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endforeach
            </div>
            <div class="paginate pb-10">
                {{$posts->links()}}
            </div>
    </body>
    <x-slot name="footer"></x-slot>
    </x-app-layout>
</html>