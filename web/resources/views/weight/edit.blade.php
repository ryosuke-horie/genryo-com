@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
    @if (!empty($weight))
        <div class="grid min-h-screen place-items-center">
            <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
                <form class="mt-6" method="POST" action="/weight/update">
                    @csrf
                    <input id="id" type="hidden" name="id" value="{{ $weight['id'] }}" />
                    <label for="weight" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">体重</label>
                    <input id="weight" type="text" name="weight" placeholder="{{ $weight['weight'] }}"
                        class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                        required />
                    <div class="flex items-center justify-center py-2">
                        <input name="memoried_at" type="datetime-local"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
                    </div>
                    <button type="submit"
                        class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                        記録
                    </button>
                </form>
            </div>
        </div>
    @else
        現在データがありません。
    @endif
@endsection

@include('./layouts/footer')