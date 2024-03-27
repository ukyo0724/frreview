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
            {{ __('投稿作成') }}
        </x-slot>
    <body>
        <form action="/posts" method="POST" id="form_post" enctype="multipart/form-data">
            @csrf
        <div class="post-edit-container">
            <div class="mx-auto max-w-md mb-5">
                <label for="title" class="mb-1 mt-10 block text-sm font-medium text-gray-700">タイトル</label>
                <input type="email" name="post[title]" id="title" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="パリでの旅行" value="{{old('post.city')}}"/>
                <p class="mt-1 text-sm text-gray-500">20文字以内でお書きください。</p>
                <p class="title_error" style="color:red">{{$errors->first('post.title')}}</p>
            </div>
            <div class="mx-auto max-w-md mt-5 mb-5">
                <label for="body" class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">投稿内容</label>
                <textarea id="body" name="post[body]"class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50" rows="3" placeholder="自身の旅行でのお話をお書きください。">{{old('post.body')}}</textarea>
                <p class="mt-1 text-sm text-gray-500">50文字以上、400文字以内でお書きください。</p>
                <p class="body_error" style="color:red">{{$errors->first('post.body')}}</p>
            </div>
            <div class="mx-auto max-w-md mt-5 mb-5">
                <label for="city" class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">都市名</label>
                <input type="email" name="post[city]" id="city" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="パリ" value="{{old('post.city')}}"/>
                <p class="mt-1 text-sm text-gray-500">訪れたフランスの都市名をお書きください。</p>
                <p class="city_error" style="color:red">{{$errors->first('post.city')}}</p>
            </div>
            <div class="mx-auto max-w-md mt-5 mb-5">
                <div>
                    <label for="address" class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">住所</label>
                        <div class="relative">
                            <div height="42px" class="pointer-events-none absolute inset-y-4 left-0 flex  items-center px-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <input type="email" name='post[address]' id="address" class="block w-full rounded-md border-gray-300 pl-10 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" placeholder="Champ de Mars, 5 Av. Anatole France, 75007 Paris" />
                            <p class="mt-1 text-sm text-gray-500">正確に住所をお書きください。</p>
                            <p class="address_error" style="color:red">{{$errors->first('post.address')}}</p>
                        </div>
                </div>
            </div>
            <div class="mx-auto max-w-md mt-5 mb-10">
                <label for="region" class="mb-1 block text-sm font-medium text-gray-700">地域</label>
                <select id="region" name="post[region_id]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50">
                    @foreach($regions as $region)
                        <option value="{{$region->id}}">{{$region->name}}</option>
                    @endforeach
                </select>
            </div>
            <p class="region_error" style="color:red">{{$errors->first('post.region')}}</p>
                
            <div class="space-y-3 mb-5">
                <div class="flex justify-center items-center space-x-2">
                  <label for="category" class="mb-1 block text-sm font-medium text-gray-700">カテゴリー : </label></br>
                    @foreach($categories as $category)
                        <input id="category" type="checkbox" value="{{$category->id}}" name="categories_array[]">
                        <label for="category" class="text-base font-medium text-gray-700">{{$category->name}}</label>
                    @endforeach
                </div>
            </div>
            <p class="categories_error" style="color:red">{{$errors->first('categories_array[]')}}</p>
            <div class="mx-auto max-w-xs">
                <label for="image" class="mb-1 block text-sm font-medium text-gray-700">Upload file</label>
                <label class="flex w-full cursor-pointer appearance-none items-center justify-center rounded-md border-2 border-dashed border-gray-200 p-6 transition-all hover:border-primary-300">
                <div class="space-y-1 text-center">
                    <div class="mx-auto inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                    </div>
                    <div class="text-gray-600">
                        <a href="#" class="font-medium text-primary-500 hover:text-primary-700">Click to upload</a> or drag and drop
                    </div>
                    <p class="text-sm text-gray-500">SVG, PNG, JPG or GIF </p>
                </div>
                <input id="image" type="file" class="sr-only" onchange="loadImage(this);" name="image[]" multiple="multiple">
                </label>
            </div>
            <div class="flex flex-row mx-auto items-center justify-center mt-7">
                <table class="table">
                    <tbody>
                        <td class="preview flex flex-row mx-auto items-center justify-center" id="imgPreviewField"></td>
                    </tbody>
                </table>
            </div>
        </div>
        <input name="post[status]" type="hidden" id="status" value="1">
        <div class="flex flex-wrap items-center justify-center mx-auto gap-5 mt-7">
            <button onclick="addPost(2)" type="button" class="inline-flex items-center gap-1.5 rounded-lg border border-blue-500 bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-green-200 disabled:cursor-not-allowed disabled:border-green-300 disabled:bg-green-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
              <path d="M9.25 13.25a.75.75 0 001.5 0V4.636l2.955 3.129a.75.75 0 001.09-1.03l-4.25-4.5a.75.75 0 00-1.09 0l-4.25 4.5a.75.75 0 101.09 1.03L9.25 4.636v8.614z" />
              <path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
            </svg>
            Upload
            </button>
            <button type="button" onclick="addPost(1)" class="inline-flex items-center gap-1.5 rounded-lg border border-green-500 bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-green-700 hover:bg-green-700 focus:ring focus:ring-green-200 disabled:cursor-not-allowed disabled:border-green-300 disabled:bg-green-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
              <path d="M9.25 13.25a.75.75 0 001.5 0V4.636l2.955 3.129a.75.75 0 001.09-1.03l-4.25-4.5a.75.75 0 00-1.09 0l-4.25 4.5a.75.75 0 101.09 1.03L9.25 4.636v8.614z" />
              <path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
            </svg>
            下書き
            </button>
        </div>
        </form>
        <div class="footer mb-64">
            <button type="button" onclick="history.back()" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-700 bg-gray-700 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-gray-900 hover:bg-gray-900 focus:ring focus:ring-gray-200 disabled:cursor-not-allowed disabled:border-gray-300 disabled:bg-gray-300">
            <svg width="16px" height="16px" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3V256v41.7L459.5 440.6zM256 352V256 128 96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V352z"/></svg>
            戻る
          </button>
        </div>
        <script>
            let key = 0;
            let currentPreviews = []; // 既存のプレビュー要素を保持する配列

            function loadImage(obj) {
             // 既存のプレビューを削除
             currentPreviews.forEach((preview) => {
             document.getElementById("imgPreviewField").removeChild(preview);
             });
             currentPreviews = []; // 配列を初期化
  
             for (let i = 0; i < obj.files.length; i++) {
             const fileReader = new FileReader();
             fileReader.onload = (function (e) {
             const field = document.getElementById("imgPreviewField");
             const figure = document.createElement("figure");
             const img = new Image();
             img.src = e.target.result;

             figure.setAttribute("id", "img-" + key);
             figure.appendChild(img);
             field.appendChild(figure);
             key++;

      // 新しいプレビューを配列に追加
             currentPreviews.push(figure);
             });
             fileReader.readAsDataURL(obj.files[i]);
            }
          }
        </script>
    </body>
    <x-slot name="footer"></x-slot>
    </x-app-layout>
    
    
    </html>