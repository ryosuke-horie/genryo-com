<div class="wrap-chart">
    <div class="chart-container" style="position: relative; width: 100%; height: 95%;">
        <canvas id="myChart"></canvas>
    </div>
</div>
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
                text: '体重ログ（1週間平均）'
            },
            maintainAspectRatio: false, // 固定アスペクト比を解除
            yAxes: [
            {
                scaleLabel: {
                    display: window.screen.width > 414,
                    //省略
                },
            },
        ]
        }
    });
</script>
<!-- グラフを描画ここまで -->
