<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/posts.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
         <script src="{{asset('js/postbtn.js')}}"></script>
         <script src="{{asset('js/googleMap.js')}}"></script>
         <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
    </head>
    <x-app-layout>
        <x-slot name="header">
            {{ __('投稿詳細') }}
        </x-slot>
    <body>
        @if (session('commentlike'))
            <div class="flex p-2 bg-blue-200 text-blue-800 p-4 text-sm rounded border border-blue-300 my-3">
                <div class="flex-shrink mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-grow">{{ session('commentlike') }}</div>
            </div>
        @endif
        @if(session('commentunlike'))
            <div class="flex p-2 bg-yellow-200 text-yellow-800 p-4 text-sm rounded border border-yellow-300 my-3">
                <div class="flex-shrink mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-grow">{{ session('commentunlike') }}</div>
            </div>
        @endif
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
        @if($post->user->id === Auth::user()->id)
        <div class="mx-auto ml-3 mt-3">
            <ul class="space-y-4">
                <li class="flex gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-100 ml-1.5">
                        <svg width="19px" height="15px" xmlns="http://www.w3.org/2000/svg" fill="#ff0000" viewBox="0 0 576 512" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-primary-500">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M576 128c0-35.3-28.7-64-64-64H205.3c-17 0-33.3 6.7-45.3 18.7L9.4 233.4c-6 6-9.4 14.1-9.4 22.6s3.4 16.6 9.4 22.6L160 429.3c12 12 28.3 18.7 45.3 18.7H512c35.3 0 64-28.7 64-64V128zM271 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl font-medium leading-loose">Delete Post</h4>
                        <p class="text-gray-500">下のボタンを押すことで投稿を削除できます</p>
                        <form action="/posts/delete/{{$post->id}}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="button" class="inline-flex items-center gap-1.5 rounded-lg border border-red-500 bg-red-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-red-700 hover:bg-red-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300" onclick="deletePost({{$post->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor" class="h-4 w-4">
                                 <path fill="currentColor" d="M13.5 6.5V7h5v-.5a2.5 2.5 0 0 0-5 0Zm-2 .5v-.5a4.5 4.5 0 1 1 9 0V7H28a1 1 0 1 1 0 2h-1.508L24.6 25.568A5 5 0 0 1 19.63 30h-7.26a5 5 0 0 1-4.97-4.432L5.508 9H4a1 1 0 0 1 0-2h7.5Zm2.5 6.5a1 1 0 1 0-2 0v10a1 1 0 1 0 2 0v-10Zm5-1a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-10a1 1 0 0 0-1-1Z" />
                            </svg>
                            削除
                        </button>
                        </form>
                    </div>
                <li class="flex gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-100">
                        <svg width="19px" height="15px" xmlns="http://www.w3.org/2000/svg" fill="#66cdaa" viewBox="0 0 512 512" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-primary-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-xl font-medium leading-loose">Edit Post</h4>
                        <p class="text-gray-500">下のボタンから投稿を編集できます</p>
                        <button onclick="location.href='{{ route('edit', ['post'=>$post->id])}}'" type="button" class="inline-flex items-center gap-1.5 rounded-lg border border-green-500 bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-green-700 hover:bg-green-700 focus:ring focus:ring-green-200 disabled:cursor-not-allowed disabled:border-green-300 disabled:bg-green-300">
                            <svg width="19px" height="15px"　xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="white">
                                <path d="M9.25 13.25a.75.75 0 001.5 0V4.636l2.955 3.129a.75.75 0 001.09-1.03l-4.25-4.5a.75.75 0 00-1.09 0l-4.25 4.5a.75.75 0 101.09 1.03L9.25 4.636v8.614z" />
                                <path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
                            </svg>
                            編集
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        @endif
        <section class="text-gray-600 body-font bg-white">
            <div class="container py-15 mx-auto flex flex-col">
                <div class="lg:w-4/6 mx-auto">
                    <div class="flex flex-col sm:flex-row mt-10">
                        <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
                            <div class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
                                @if($post->user->image_user)
                                    <img src="{{$post->user->image_user}}" class="h-full w-full rounded-full object-cover object-center sm:w-20 sm:h-20 h-20 w-20">
                                @else
                                    <img src="{{asset('images/paris.jpg')}}" class="h-full w-full rounded-full object-cover object-center sm:w-20 sm:h-20 h-20 w-20">
                                @endif
                            </div>
                            <div class="flex flex-col items-center text-center justify-center">
                                <h2 class="font-medium title-font mt-4 text-gray-900 text-xl"><a class="user" href='/users/{{$post->user_id}}'>User：{{$post->user->name}}</a></h2>
                                <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
                                <p class="text-base text-lg">Title: {{$post->title}}</p>
                            </div>
                        </div>
                        <div class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                            <p class="leading-relaxed text-lg mb-4">{{$post->body}}</p>
                            <div class="flex flex-wrap justify-center gap-2">
                                <span class="rounded-full bg-primary-50 px-3 py-1 text-sm font-semibold text-red-600">
                                    <a href="/regions/{{$post->region->id}}">{{ $post->region->name}}</a></span>
                                <span class="rounded-full bg-green-50 px-3 py-1 mr-5 text-sm font-semibold text-green-600">
                                    @foreach($post->categories as $category)
                                        <a  href="/categories/{{$category->id}}">{{ $category->name }}</a>
                                    @endforeach
                                </span>
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
                            </div>
                        </div>
                    </div>
                </div>
                <table class="lg:w-3/4 flex flex-start justify-center items-center mx-auto mt-7">
                @foreach($post->images as $image)
                    @if($image->image_url)
                        <td class="border-spacing-6">
                            <div>
                                <img src="{{$image->image_url}}" alt="画像が読み込めません"/>
                            </div>
                        </td>
                    @endif
                @endforeach
                </table>
                <div class="flex justify-center">
                    <div class="mt-6 lg:w-5/12 overflow-hidden rounded-lg bg-white shadow">
                        <div id="google_map" class="h-96 items-center justify-center" allowfullscreen="" loading="lazy"></div>
                            <div class="p-4">
                                <p class="mb-1 text-sm text-primary-500">{{$post->updated_at}}</p>
                                <h3 class="text-xl font-medium text-gray-900">都市名：{{$post->city}}</h3>
                                <p class="mt-1 text-gray-500" id="address">{{$post->address}}</p>
                                <div class="mt-4 flex gap-2">
                                    <span class="rounded-full bg-primary-50 py-1 text-sm font-semibold text-red-600"><a href="/regions/{{$post->region->id}}">{{ $post->region->name}}</a></span>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-comment">
            <div class="mx-auto max-w-md mt-8">
                <div class="relative overflow-hidden rounded-md border border-gray-300 shadow-sm focus-within:border-primary-300 focus-within:ring focus-within:ring-primary-200 focus-within:ring-opacity-50">
                    <form action="{{route('comment.store', ['post'=>$post->id])}}" method="POST" id="form_comment_{{$post->id}}">
                    @csrf
                    <textarea name="comment" class="block w-full border-0 focus:border-0 focus:ring-0" rows="3" placeholder="Leave a message"></textarea>
                    <p class="mt-1 text-sm text-gray-500">100文字以内でお書きください。</p>
                    <p class="comment_error" style="color:red">{{$errors->first('comment')}}
                    <div class="flex w-full items-center flex-row-reverse justify-between bg-white p-2">
                        <button  onclick="addComment({{$post->id}})" type="button" class="rounded border border-blue-500 bg-blue-500 px-2 py-1.5 text-center text-xs font-medium text-white shadow-sm transition-all hover:bg-blue-700 focus:ring focus:ring-blue-100">Comment</button>
                    </div>
                    </form>
                </div>
            </div>
            @foreach($comments as $comment)
                <div class="flex items-start gap-2.5 items-center justify-center mt-11">
                    <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1645378999013-95abebf5f3c1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Jese image">
                    <div class="flex flex-col w-4/5 itemx-center justify-center  max-w-[320px] leading-1.5 p-4 border-blue-200 bg-blue-100 rounded-e-xl rounded-es-xl dark:bg-blue-700">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{$comment->user->name }}</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{$comment->updated_at}}</span>
                        </div>
                            <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{$comment->content}}</p>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
                            <div class="like leading-relaxed text-base">
                                @if($comment->is_liked_by_auth_user())
                                    <form action="{{ route('comment.unlike', ['comment'=>$comment->id])}}" method="POST">
                                    @csrf
                                    <button type=submit class="btn btn-success btn-sm flex flex-row gap-1">
                                        <svg width="18px" height="18px" fill="red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 440"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                        </svg>
                                        <span class="budge text-base">{{$comment->likes->count() }}</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('comment.like', ['comment'=>$comment->id])}}" method="POST">
                                    @csrf
                                    <button type=submit class="btn btn-success btn-sm flex flex-row gap-1">
                                    <svg width="18px" height="18px" fill="#111827" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 440"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/>
                                    </svg>
                                    <span class="budge text-base">{{$comment->likes->count() }}</span>
                                    </button>
                                    </form>
                                @endif
                            </div>
                    </div>
                </div>
            @endforeach
            <div class="paginate">
                {{$comments->links()}}
            </div>
            <div class="footer mt-10 mb-64">
                <button type="button" onclick="location.href='https://b4744f82cdbd4f6ca8229f8f9f1cfd9c.vfs.cloud9.eu-north-1.amazonaws.com/'" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-700 bg-gray-700 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-gray-900 hover:bg-gray-900 focus:ring focus:ring-gray-200 disabled:cursor-not-allowed disabled:border-gray-300 disabled:bg-gray-300">
                    <svg width="16px" height="16px" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3V256v41.7L459.5 440.6zM256 352V256 128 96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V352z"/></svg>
                    戻る
                </button>
            </div>
    </body>
    <x-slot name="footer"></x-slot>
    </x-app-layout>
    </html>