<?php
include_once('conexao.php');
$id = $_POST['id'] ?? '';
$maquina_id = $_POST['maquina_id'] ?? '';
$pecas_boas = $_POST['pecas_boas'] ?? '';
$pecas_defeituosas = $_POST['pecas_defeituosas'] ?? '';
$status = $_POST['status'] ?? '';

$stmt = $pdo->prepare("SELECT id FROM registros_producao WHERE id = ?");
$stmt->execute([$id]);
if ($stmt->rowCount() === 0) {
    echo "Máquina não encontrada.";
    exit;
} else {
    $stmt = $pdo->prepare("UPDATE registros_producao SET maquina_id = ?, pecas_boas = ?, pecas_defeituosas = ?, status = ? WHERE id = ?");
    if ($stmt->execute([$maquina_id, $pecas_boas, $pecas_defeituosas, $status, $id])) {
        echo "Máquina atualizada com sucesso!";
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar máquina.";
        exit();
    }
}
?>
