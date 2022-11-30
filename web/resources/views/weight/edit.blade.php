@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
<div class="grid min-h-screen place-items-center">
    <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
      <form class="mt-6" method="POST" action="/weight/memoryWeight">
        @csrf
        <label for="weight" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">体重</label>
        <input id="weight" type="text" name="weight" placeholder="{{ $weight['weight'] }}" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" required />
        <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
            記録
        </button>
      </form>
    </div>
  </div>
@endsection

@include('./layouts/footer')