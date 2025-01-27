<?php
$host = "localhost";
$port = "";
$user = "user";
$password = "";
$database = "consultacare";

$conn = new mysqli($host, $user, $password, $database, $port);


if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
echo "Conexão bem-sucedida com MariaDB!";

