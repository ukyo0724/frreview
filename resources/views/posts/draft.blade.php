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
            {{ __('下書き一覧') }}
        </x-slot>
    <body>
        @if($posts->count()>=1)
            <div class="rounded-lg overflow-hidden flex flex-col mt-10 mb-50">
                <table class="w-11/12 mx-auto mb-96">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Name</th>
                            <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Title</th>
                            <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Date</th>
                            <th class="w-1/4 py-4 px-6 text-left text-gray-600 font-bold uppercase">Status</th>
                        </tr>
                    </thead>
                    @foreach($posts as $post)
                        <tbody class="bg-white w-max">
                            <tr>
                                <td class="py-4 px-6 border-b border-gray-200">{{ Auth::user()->name }}</td>
                                <td class="py-4 px-6 border-b border-gray-200 truncate">{{$post->title}}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{$post->updated_at}}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <a href="{{route('draftedit', ['post'=>$post->id])}}" class="bg-green-500 text-white py-1 px-2 rounded-full text-xs">編集する</a>
                                </td>
                            </tr>
                <!-- Add more rows here -->
                        </tbody>
                    @endforeach
                </table>
             </div>
        @else
            <section class="text-gray-600 body-font">
                <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                      <svg width="500px" height="450px" fill="#4169e1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M80 32C62.3 32 48 46.3 48 64V224v96H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H48v64c0 17.7 14.3 32 32 32s32-14.3 32-32V384h80c17.7 0 32-14.3 32-32s-14.3-32-32-32H112V256H256c17.7 0 32-14.3 32-32s-14.3-32-32-32H112V96H288c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg>
                    </div>
                    <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                        <h1 class="title-font sm:text-4xl text-2xl mb-4 font-medium text-gray-900">一つの投稿も下書き保存されていません。
                        </h1>
                        <p class="mb-8 leading-relaxed">下記のボタンから投稿ができます。下書き機能も活用しフランスでの経験、
                        </br class="mb-8 leading-relaxed">知識をシェアして可能性を広げましょう！</p>
                        <div class="flex justify-center">
                        <button onclick="location.href='https://b4744f82cdbd4f6ca8229f8f9f1cfd9c.vfs.cloud9.eu-north-1.amazonaws.com/posts/create'" class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">投稿</button>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </body>
    <x-slot name="footer"></x-slot>
    </x-app-layout>
    </html>