@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">出場体重設定</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">次回の試合で出場する体重と計量日を設定しましょう。<br>＊体重のグラフにも反映されます。</p>
      </div>
      <div class="lg:w-1/2 md:w-2/3 mx-auto">
        <form action="/gameWeight/store" method="POST">
            @csrf
            <div class="flex flex-wrap -m-2">
                <div class="p-2 w-1/2">
                  <div class="relative">
                    <label for="game_weight" class="leading-7 text-sm text-gray-600">出場体重</label>
                    <input autofocus required type="number" step="0.1" id="game_weight" name="game_weight" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                  </div>
                </div>
                <div class="p-2 w-1/2">
                  <div class="relative">
                    <label for="email" class="leading-7 text-sm text-gray-600">軽量日</label>
                    <input required type="date" id="weight_in" name="weight_in" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                  </div>
                </div>
                <div class="p-2 w-full">
                  <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">設定</button>
                </div>
              </div>
        </form>
      </div>
    </div>
  </section>
@endsection

@include('./layouts/footer')