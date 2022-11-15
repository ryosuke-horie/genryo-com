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

    //最小体重ログ
    var weight_log = @json($weight_log);

    //グラフを描画
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: '体重',
                    data: weight_log,
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
            // 固定アスペクト比を解除（レスポンシブ）
            maintainAspectRatio: false,
            // ラベルを非表示（レスポンシブ）
            yAxes: [
            {
                scaleLabel: {
                    display: window.screen.width > 414,
                },
            },
        ]
        }
    });
</script>
<!-- グラフを描画ここまで -->
