<?php
include('conexao.php');

$query = "SELECT id, data_hora, especialidade FROM consulta";
$resultado = mysqli_query($conn, $query);

if (mysqli_num_rows($resultado) > 0) {
    $consultas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $consultas[] = $row;
    }
} else {
    echo "Nenhuma consulta encontrada.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2dRzbdexmZjF3/NW8MbZgsZ3r8g2PVuIuGnDgM3vqHeZ9M5onVKpnIF57r4d" crossorigin="anonymous">
    <link rel="stylesheet" href="css/paciente.css">
    <title>Consultas</title>
</head>

<body class="d-flex justify-content-center align-items-start" style="min-height: 100vh; padding-top: 20px;">
    <div class="container">
        <h1 class="mb-4">Minhas Consultas</h1>
        <table class="table table-bordered">
            <thead class="table-info"> 
                <tr>
                    <th>ID</th>
                    <th>Data e Hora</th>
                    <th>Especialidade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach ($consultas as $consulta) {
                    echo "<tr>
                        <td>{$consulta['id']}</td>
                        <td>{$consulta['data_hora']}</td>
                        <td>{$consulta['especialidade']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybYb3rS3pL2F6d1Ubf3vJrpz5Yb3wVVyLQQvcJ3wYQp6F5+Y8F" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cuF4zx82x+aJ5Ht30/6ZTqPjmEZYgokyQbm1HsX1WBsmXUWh5Ls15TKyTURac7Y+" crossorigin="anonymous"></script>
</body>
</html>
