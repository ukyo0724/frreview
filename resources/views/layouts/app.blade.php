<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <!--page footer-->
            @if (isset($footer))
                <footer class="text-gray-600 body-font border-t 10 border-gray-600 mt-24">
                  <div class="container px-5 py-24 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
                    <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left md:mt-0 mt-10">
                      <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width=8px height=10px fill="#000000" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-green-500 rounded-full" viewBox="0 0 640 512">
                          <path d="M381 114.9L186.1 41.8c-16.7-6.2-35.2-5.3-51.1 2.7L89.1 67.4C78 73 77.2 88.5 87.6 95.2l146.9 94.5L136 240 77.8 214.1c-8.7-3.9-18.8-3.7-27.3 .6L18.3 230.8c-9.3 4.7-11.8 16.8-5 24.7l73.1 85.3c6.1 7.1 15 11.2 24.3 11.2H248.4c5 0 9.9-1.2 14.3-3.4L535.6 212.2c46.5-23.3 82.5-63.3 100.8-112C645.9 75 627.2 48 600.2 48H542.8c-20.2 0-40.2 4.8-58.2 14L381 114.9zM0 480c0 17.7 14.3 32 32 32H608c17.7 0 32-14.3 32-32s-14.3-32-32-32H32c-17.7 0-32 14.3-32 32z"/></path>
                        </svg>
                        <span class="ml-3 text-xl">Freille</span>
                      </a>
                      <p class="mt-2 text-sm text-gray-500">Make you fond of France</p>
                    </div>
                    <div class="flex-grow flex flex-wrap md:pr-20 -mb-10 md:text-left text-center order-first">
                      <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                          <li>
                            <a href="/regions/1" class="text-gray-600 hover:text-gray-800">北仏</a>
                          </li>
                          <li>
                            <a href="{{ route('region', ['region' => 2]) }}" class="text-gray-600 hover:text-gray-800">東仏</a>
                          </li>
                          <li>
                            <a href="{{ route('region', ['region' => 3]) }}" class="text-gray-600 hover:text-gray-800">南仏</a>
                          </li>
                          <li>
                            <a href="{{ route('region', ['region' => 4]) }}" class="text-gray-600 hover:text-gray-800">西仏</a>
                          </li>
                          <li>
                            <a href="{{ route('region', ['region' => 5]) }}" class="text-gray-600 hover:text-gray-800">中部</a>
                          </li>
                        </nav>
                      </div>
                      <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                        <h2 class="title-font font-medium text-gray-900 tracking-widest text-sm mb-3">CATEGORIES</h2>
                        <nav class="list-none mb-10">
                          <li>
                            <a href="{{ route('category', ['categories' => 1]) }}" class="text-gray-600 hover:text-gray-800">食事</a>
                          </li>
                          <li>
                            <a href="{{ route('category', ['categories' => 2]) }}" class="text-gray-600 hover:text-gray-800">歴史</a>
                          </li>
                          <li>
                            <a class="text-gray-600 hover:text-gray-800">Third Link</a>
                          </li>
                          <li>
                            <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
                          </li>
                        </nav>
                      </div>
                    </div>
                  </div>
                  <div class="bg-gray-100">
                    <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                      <p class="text-gray-500 text-sm text-center sm:text-left">© 2024 Freille
                      </p>
                      <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                        <a class="text-gray-500">
                          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                          </svg>
                        </a>
                        <a class="ml-3 text-gray-500">
                          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                          </svg>
                        </a>
                        <a class="ml-3 text-gray-500">
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                          </svg>
                        </a>
                        <a class="ml-3 text-gray-500">
                          <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                          </svg>
                        </a>
                      </span>
                    </div>
                  </div>
                </footer>
                @endif
        </div>
    </body>
</html>
