<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $consulta_id = $_POST['consulta_id'];
    $data_hora = $_POST['data_hora'];
    $especialidade = $_POST['especialidade'];

    // Atualizar a consulta no banco de dados
    $query = "UPDATE consulta SET data_hora = '$data_hora', especialidade = '$especialidade' WHERE id = $consulta_id";
    
    if (mysqli_query($conn, $query)) {
        echo "Consulta atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar consulta: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

