    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            [ 'Máquina', 'Peças Boas', 'Peças Defeituosas' ],
            <?php 
                $sql_grafico = "SELECT maquina_id, SUM(pecas_boas) AS total_boas, SUM(pecas_defeituosas) AS total_def FROM registros_producao GROUP BY maquina_id";
                $res_grafico = mysqli_query($conn, $sql_grafico);
                if ($res_grafico) {
                    while ($row = mysqli_fetch_assoc($res_grafico)) {
                        $maquina = $row['maquina_id'] ?? 'Desconhecido';
                        $total_boas = $row['total_boas'] ?? 0;
                        $total_def = $row['total_def'] ?? 0;
                        echo "['$maquina', $total_boas, $total_def],";
                    }
                }
            ?>
        ]);

        var options = {
          title: 'Relatório de Máquinas - Peças Boas e Defeituosas',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <div id="donutchart" style="width: 620px; height: 420px;"></div>