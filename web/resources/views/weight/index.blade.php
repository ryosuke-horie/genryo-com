@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 flex-col items-center">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                {{-- グラフ部分の読み込み --}}
                @include('weight.weight-graph', [
                    'label' => $label,
                    'avg_weight_log' => $avg_weight_log,
                    'max_weight_log' => $max_weight_log,
                    'min_weight_log' => $min_weight_log,
                ])
            </div>

            <div class="lg:flex-grow md:w-1/2 lg:pl-24 flex flex-col md:items-start md:text-left items-center text-center">
                <div class="flex justify-center">
                    <button onclick="showModal()"
                        class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                        入力
                    </button>
                    <button onclick="moveShow()"
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
<script>
    // 入力ページに遷移。
    function moveInput() {
        window.location.href = '/weight/input';
    }

    // 詳細ページに遷移。
    function moveShow() {
        window.location.href = '/weight/show';
    }

    // モーダルを隠す。
    function hideModal() {
        let modal = document.getElementsByClassName("modal");
        modal[0].classList.add("hidden");
    }

    // モーダルを表示。
    function showModal() {
        let modal = document.getElementsByClassName("modal");
        modal[0].classList.remove("hidden");
    }
</script>

<style>
    .hedeen {
        display: none;
    }
    .popup {
        position: fixed;
        inset: 0;
        margin: auto;
    }

    /* グラフ用 */
.wrap-chart {
    width: 100%;
    height: 700px;
}
@media (max-width: 480px) {
    .wrap-chart {
        height: 400px;
    }
}
</style>
