<link rel="stylesheet" href="{{asset('css/posts.css')}}">
<x-app-layout>
    <div class="mv">
  <!--  メイン全体を囲うdiv  -->
  <div class="mv-wrap">
    <!--   薄いレイヤー   -->
    <div class="mv-bg"></div>
    <!--   videoタグ   -->
    <video class="video" webkit-playsinline="" playsinline="" muted="" autoplay="" loop=""
      src="{{asset('images/dash.mp4')}}"></video>
    <!--   動画の上に載せるテキスト   -->
    <p class="mv-txt">Freille</p>
  </div>
</div>
<section class="text-gray-600 body-font mt-14">
  <div class="container mt-16 px-5 py-40 mx-auto">
    <div class="text-center mb-20">
      <h1 class="lg:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">旅行の新たな可能性を広げよう</h1>
      <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">フランスは世界で一番訪れられている国。</br>このサイトはフランス旅行の可能性を広げるのに役立つと私は考えます。</p>
    </div>
    <div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
      <div class="p-2 sm:w-1/2 w-full">
        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
            <path d="M22 4L12 14.01l-3-3"></path>
          </svg>
          <span class="title-font font-medium">多数の文化スポット</span>
        </div>
      </div>
      <div class="p-2 sm:w-1/2 w-full">
        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
            <path d="M22 4L12 14.01l-3-3"></path>
          </svg>
          <span class="title-font font-medium">世界三大料理の一つであるフランス料理</span>
        </div>
      </div>
      <div class="p-2 sm:w-1/2 w-full">
        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
            <path d="M22 4L12 14.01l-3-3"></path>
          </svg>
          <span class="title-font font-medium">日本とは一味違うショッピング</span>
        </div>
      </div>
      <div class="p-2 sm:w-1/2 w-full">
        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
            <path d="M22 4L12 14.01l-3-3"></path>
          </svg>
          <span class="title-font font-medium">自然が美しい地域の数々</span>
        </div>
      </div>
      <div class="p-2 sm:w-1/2 w-full">
        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
            <path d="M22 4L12 14.01l-3-3"></path>
          </svg>
          <span class="title-font font-medium">ルーブルをはじめとするアート鑑賞</span>
        </div>
      </div>
      <div class="p-2 sm:w-1/2 w-full">
        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
            <path d="M22 4L12 14.01l-3-3"></path>
          </svg>
          <span class="title-font font-medium">歴史的なスポット</span>
        </div>
      </div>
    </div>
    <button onclick="location.href='https://b4744f82cdbd4f6ca8229f8f9f1cfd9c.vfs.cloud9.eu-north-1.amazonaws.com/'" class="flex mx-auto w-11 mt-16 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">投稿一覧</button>
  </div>
</section>
<x-slot name="footer"></x-slot>
</x-app-layout>
