@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
    <link rel="stylesheet" href="{{ asset('/css/weight.css') }}">
    @include('weight.game-weight', [
        "game_weight" => $game_weight,
        "weight_in"   => $weight_in,
    ])
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 flex-col items-center">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                {{-- グラフ部分の読み込み --}}
                @include('weight.weight-graph', [
                    'label' => $label,
                    'weight_log' => $weight_log,
                    "game_weight" => $game_weight_log,
                ])
            </div>

            <div class="lg:flex-grow md:w-1/2 lg:pl-24 flex flex-col md:items-start md:text-left items-center text-center">
                <div class="flex justify-center">
                    <button onclick="showModal()"
                        class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                        入力
                    </button>
                    <button onclick="moveDetail()"
                        class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">
                        詳細
                    </button>
                </div>
            </div>
        </div>

        {{-- モーダル部分の読み込み --}}
        @include('weight.input-modal', ['now' => $now])

    </section>
@endsection

@include('./layouts/footer')
<script src="{{ asset('js/weight.js') }}"></script>