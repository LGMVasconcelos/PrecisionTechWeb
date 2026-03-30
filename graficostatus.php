    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [ 'Status', 'Quantidade' ],
            <?php 
                $sql_grafico = "SELECT status, COUNT(*) AS quantidade FROM registros_producao GROUP BY status";
                $res_grafico = mysqli_query($conn, $sql_grafico);
                if ($res_grafico) {
                    while ($row = mysqli_fetch_assoc($res_grafico)) {
                        $status = $row['status'] ?? 'Desconhecido';
                        $quantidade = $row['quantidade'] ?? 0;
                        echo "['$status', $quantidade],";
                    }
                }
            ?>
        ]);

        var options = {
          title: 'Relatório de Status das Máquinas',
          pieHole: 0.4,
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <div id="donutchart" style="width: 620px; height: 420px;"></div>