<?php

// include('conexao.php');

header('Content-Type: application/json')
;
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


$data_hora = $_POST['data_hora'];
$especialidade = $_POST['especialidade'];
$paciente_id = $_POST['paciente_id'];

// SQL para inserir os dados
$sql = "INSERT INTO consulta (data_hora, especialidade, paciente_id) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $data_hora, $especialidade, $paciente_id);


if ($stmt->execute()) {
  
    $response = array(
        'success' => true,
        'consulta_id' => $stmt->insert_id,
        'data_hora' => $data_hora,
        'especialidade' => $especialidade
    );
} else {

    $response = array(
        'success' => false,
        'message' => "Erro ao inserir consulta: " . $stmt->error
    );
}

$stmt->close();
$conn->close();

echo json_encode($response);




