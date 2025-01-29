<?php
$host = "127.0.0.1";
$port = 3306;
$user = "root";
$password = "";
$database = "consultacare";

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
// echo "Conexão bem-sucedida!";


