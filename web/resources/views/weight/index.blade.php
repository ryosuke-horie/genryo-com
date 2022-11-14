@extends('layouts/parents')
@include('./layouts/head')
@include('./layouts/header')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                {{-- <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600"> --}}
                <h1>グラフ</h1>
                <canvas id="myChart"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
                <!-- グラフを描画 -->
                <script>
                    //ラベル
                    var labels = @json($label);

                    //平均体重ログ
                    var average_weight_log = @json($avg_weight_log);

                    //最大体重ログ
                    var max_weight_log = @json($max_weight_log);

                    //最小体重ログ
                    var min_weight_log = @json($min_weight_log);

                    //グラフを描画
                    var ctx = document.getElementById("myChart");
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: '平均体重',
                                    data: average_weight_log,
                                    borderColor: "rgba(0,0,255,1)",
                                    backgroundColor: "rgba(0,0,0,0)"
                                },
                                {
                                    label: '最大',
                                    data: max_weight_log,
                                    borderColor: "rgba(0,255,0,1)",
                                    backgroundColor: "rgba(0,0,0,0)"
                                },
                                {
                                    label: '最小',
                                    data: min_weight_log,
                                    borderColor: "rgba(255,0,0,1)",
                                    backgroundColor: "rgba(0,0,0,0)"
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: '体重ログ（６ヶ月平均）'
                            }
                        }
                    });
                </script>
                <!-- グラフを描画ここまで -->
            </div>
            <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
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

        {{-- モーダル部分 --}}
        <div class="relative flex justify-center modal hidden">
            <div x-transition:enter="transition duration-300 ease-out"
                x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div
                        class="popup relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                        <div>
                            {{-- アイコンをおく予定 --}}
                            {{-- <div class="flex items-center justify-center ">
                                <img class="object-cover w-12 h-12 rounded-full ring ring-white"
                                    src="https://images.unsplash.com/photo-1490195117352-aa267f47f2d9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                                    alt="">
                                <img class="object-cover w-12 h-12 -mx-4 rounded-full ring ring-white"
                                    src="https://images.unsplash.com/photo-1500917293891-ef795e70e1f6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                                    alt="">
                                <img class="object-cover w-12 h-12 rounded-full ring ring-white"
                                    src="https://images.unsplash.com/photo-1496345875659-11f7dd282d1d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
                                    alt="">
                            </div> --}}

                            <div class="mt-4 text-center">
                                <h3 class="font-medium leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                                    体重を記録
                                </h3>

                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    現在時刻で体重を記録します。
                                </p>
                            </div>
                        </div>

                        <form class="mt-6" method="POST" action="/weight/memoryWeight">
                            @csrf
                            <div class="mt-4">
                                <label class="text-sm text-gray-700 dark:text-gray-200" for="share link">体重</label>

                                <div class="flex items-center mt-2 -mx-1">
                                    <input id="weight" type="text" name="weight" placeholder="60"
                                        class="flex-1 block h-10 px-4 mx-1 text-sm text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring"
                                        required>kg
                                    <input type="hidden" value="{{ $now }}" name="date_key">
                                </div>
                            </div>

                            <div class="mt-4 sm:mt-6 sm:flex sm:items-center sm:-mx-2">
                                <button type="submit"
                                    class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                    入力
                                </button>

                                <button onclick="hideModal()"
                                    class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
</style>
