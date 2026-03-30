<?php
include_once('conexao.php');
session_start();
$sql_fabricantes = "SELECT maquina_id, pecas_boas, pecas_defeituosas FROM registros_producao";
$res_fabricantes = mysqli_query($conn, $sql_fabricantes);
$fabricantes = 0;
if ($res_fabricantes) {
    $row = mysqli_fetch_assoc($res_fabricantes);
    $fabricantes = $row['maquina_id'] ?? 0;
}
$result = mysqli_query($conn, $sql_fabricantes);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelist.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Informações dos Fabricantes e Veículos</title>
</head>
<body>
    <div class="container">
        <img src="img/PRECISIONTECH.png" alt="Logo da PrecisionTech" class="logo" style="width: 100%; height: auto;">
        <h1>Dashboard de Produção - PrecisionTech</h1>
        <table>
            <thead>
                <tr>
                    <th>ID da máquina</th>
                    <th>Peças boas</th>
                    <th>Peças defeituosas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['maquina_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['pecas_boas']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['pecas_defeituosas']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3">Nenhum registro encontrado.</td></tr>';
                }
                ?>
            </tbody>
            <nav>
                <?php include_once('graficopecas.php')?>
            </nav>
            <nav>
                <?php include_once('graficostatus.php')?>
            </nav>
        </table>
    </div>
</body>
</html>