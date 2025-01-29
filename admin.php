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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2dRzbdexmZjF3/NW8MbZgsZ3r8g2PVuIuGnDgM3vqHeZ9M5onVKpnIF57r4d" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - Gerenciar Consultas</title>
</head>
<body class="d-flex justify-content-center align-items-start">
    <div class="container">
        <h1 class="mb-4">Gerenciar Consultas</h1>
        
        <form id="consultaForm">
            <div class="form-row">
                <input type="datetime-local" name="data_hora" class="form-control" placeholder="Data e Hora" required>
                <input type="text" name="especialidade" class="form-control" placeholder="Especialidade" required>
                <input type="hidden" name="paciente_id" value="1">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Adicionar Consulta</button>
        </form>

        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Data e Hora</th>
                    <th>Especialidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="consultaTableBody">
                <?php
                if (!empty($consultas)) {
                    foreach ($consultas as $consulta) {
                        $data_hora = new DateTime($consulta['data_hora']);
                        $data_formatada = $data_hora->format('d/m/Y H:i');
                        
                        echo "
                            <tr>
                                <td>{$consulta['id']}</td>
                                <td>{$data_formatada}</td>
                                <td>{$consulta['especialidade']}</td>
                            <td>
                                <button class='btn btn-warning btn-sm'>Editar</button>
                                <button class='btn btn-danger btn-sm' data-consulta-id='{$consulta['id']}'>Excluir</button>
                            </td>

                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhuma consulta encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybYb3rS3pL2F6d1Ubf3vJrpz5Yb3wVVyLQQvcJ3wYQp6F5+Y8F" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cuF4zx82x+aJ5Ht30/6ZTqPjmEZYgokyQbm1HsX1WBsmXUWh5Ls15TKyTURac7Y+" crossorigin="anonymous"></script>
    <script src="js/admin.js"></script>

</body>
</html>
