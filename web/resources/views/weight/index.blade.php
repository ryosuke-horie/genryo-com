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
            <div
                class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Before they sold out
                    <br class="hidden lg:inline-block">readymade gluten
                </h1>
                <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant
                    cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic
                    tumeric truffaut hexagon try-hard chambray.</p>
                <div class="flex justify-center">
                    <button onclick="moveInput()"
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
    </section>
@endsection

@include('./layouts/footer')
<script>
    function moveInput() {
        window.location.href = '/weight/input';
    }

    function moveShow() {
        window.location.href = '/weight/show';
    }
</script>
