<div class="wrap-chart">
    <div class="chart-container" style="position: relative; width: 100%; height: 95%;">
        <canvas id="myChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<!-- グラフを描画 -->
<script>
    // ラベル
    var labels = @json($label);
    // 体重ログ
    var weight_log = @json($weight_log);
    // 試合体重
    let game_weight = @json($game_weight)
    // Y軸の最大値
    let y_max = parseInt(game_weight[0]) + 10;
    // Y軸の最小値
    let y_min = game_weight[0] - 10;

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
                },
                {
                    label: '試合体重',
                    data: game_weight,
                    borderColor: "rgba(0,255,77,0.7)",
                    backgroundColor: "rgba(0,0,0,0)"
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: '体重ログ（1週間平均）'
            },
            spanGaps: true, //値が抜け落ちていた時、埋めるか否か
            // 固定アスペクト比を解除（レスポンシブ）
            maintainAspectRatio: false,
            // ラベルを非表示（レスポンシブ）
            scales: {
                yAxes: [
            {
                scaleLabel: {
                    display: window.screen.width > 414,
                },
                ticks: {
                    min: y_min,
                    max: y_max,
                },
            },
        ]
            }
            
        }
    });
</script>
<!-- グラフを描画ここまで -->
