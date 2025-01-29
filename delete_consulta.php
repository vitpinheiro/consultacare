<?php
$host = "127.0.0.1";
$port = 3306;
$user = "root";
$password = "";
$database = "consultacare";

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    echo json_encode(array('success' => false, 'message' => 'Erro na conexão com o banco de dados: ' . $conn->connect_error));
    exit();
}


if (isset($_POST['consulta_id'])) {
    $consulta_id = $_POST['consulta_id'];

  
    $sql = "DELETE FROM consulta WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $consulta_id);

    if ($stmt->execute()) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'message' => "Erro ao excluir consulta: " . $stmt->error);
    }

    $stmt->close();
} else {
    $response = array('success' => false, 'message' => 'ID da consulta não fornecido.');
}

$conn->close();
echo json_encode($response);

