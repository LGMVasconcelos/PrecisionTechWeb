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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <title>Informações dos Fabricantes e Veículos</title>
</head>

<body>
    <div class="container">
        <img src="img/PRECISIONTECH.png" alt="Logo da PrecisionTech" class="logo" style="width: 15%; height: auto;">
        <h1>Dashboard de Produção - PrecisionTech</h1>
        <form action="inserir.php" method="POST">
            <div class="mb-3">
                <label for="maquina_id" class="form-label">Id da máquina:</label>
                <input type="number" class="form-control" id="maquina_id" name="maquina_id" required>
            </div>
            <div class="mb-3">
                <label for="Peças boas" class="form-label">Peças boas:</label>
                <input type="number" class="form-control" id="pecas_boas" name="pecas_boas" required>
            </div>
            <div class="mb-3">
                <label for="pecas_defeituosas" class="form-label">Peças defeituosas:</label>
                <input type="number" class="form-control" id="pecas_defeituosas" name="pecas_defeituosas" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Status:</label>
                <select class="form-select" id="genero" name="genero" required>
                    <option value="">Selecione</option>
                    <option value="Operando">Operando</option>
                    <option value="Parada">Parada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Inserir</button>
        </form>
        <table>
            <tr>
                <th> ID da máquina: </th>
                <th> Peças boas: </th>
                <th> Peças defeituosas: </th>
                <th> Status: </th>
                <th>Ações: </th>
            </tr>
            <br>
            <?php
            $sql = "SELECT * FROM clientes";
            $stmt = $pdo->query($sql);
    
            while ($row = $stmt->fetch()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['maquina_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['pecas_boas']) . '</td>';
                echo '<td>' . htmlspecialchars($row['pecas_defeituosas']) . '</td>';
                echo '<td>' . htmlspecialchars($row['status']) . '</td>';

                echo '<td>';
                echo '<button type="button" class="btn btn-primary" style="margin-bottom: 5px;" data-bs-toggle="modal" data-bs-target="#editarModal' . $row['id'] . '">Editar</button>';
                echo '<br>';
                echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal' . $row['id'] . '">Excluir</button>';

                echo '</td>';
                echo '<div class="modal fade" tabindex="-1" id="editarModal' . $row['id'] . '" aria-labelledby="editModal" aria-hidden="true">';
                echo '    <div class="modal-dialog">';
                echo '        <div class="modal-content">';
                echo '            <div class="modal-header">';
                echo '                <h5 class="modal-title">Editar máquina</h5>';
                echo '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '            </div>';
                echo '            <div class="modal-body">';
                echo '                <form action="validar_edicao.php" method="POST">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '"';
                echo '                    <label for="id">Editando a máquina: ' . $row['maquina_id'] . '</label>';
                echo '<div class="mb-3">';
                echo '    <label for="maquina_id" class="form-label">Máquina:</label>';
                echo '    <input type="number" class="form-control" id="maquina_id" name="maquina_id" required value=' . $row['maquina_id'] . '>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="pecas_boas" class="form-label">Peças Boas:</label>';
                echo '<input type="number" class="form-control" id="pecas_boas" name="pecas_boas" required value=' . $row['pecas_boas'] . '>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="pecas_defeituosas" class="form-label">Peças Defeituosas:</label>';
                echo '<input type="number" class="form-control" id="pecas_defeituosas" name="pecas_defeituosas" required value=' . $row['pecas_defeituosas'] . '>';
                echo '</div>';
                echo '<div class="mb-3">';
                echo '<label for="status" class="form-label">Status:</label>';
                echo '<select class="form-select" id="status" name="status" required>';
                echo '<option disabled value="">Selecione</option>';
                echo '<option value="Operando">Operando</option>';
                echo '<option value="Parada">Parada</option>';
                echo '</select>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Editar</button>';
                echo '</form>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '<div class="modal fade" tabindex="-1" id="deleteModal' . $row['id'] . '" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir máquina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>';
                echo '<div class="modal-body">';
                echo '<form action="validar_exclusao.php" method="POST">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '"';
                echo '<label for="id">Tem certeza que deseja excluir a máquina: ' . $row['maquina_id'] . '?</label>';
                echo '<button type="submit" class="btn btn-danger">Excluir</button>';
                echo '</form>';
                echo '</div>';

                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            }
            echo '</tr>';
            ?>
        </table>
            <div class="graficos">
                <nav>
                    <?php include_once('graficopecas.php') ?>
                </nav>
                <nav>
                    <?php include_once('graficostatus.php') ?>
                </nav>
            </div>
        </table>
    </div>
</body>

</html>