<?php
include('conexao.php');


$por_pagina = 10;


$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina - 1) * $por_pagina;


$query_total = "SELECT COUNT(*) as total FROM consulta";
$resultado_total = mysqli_query($conn, $query_total);
$row_total = mysqli_fetch_assoc($resultado_total);
$total_consultas = $row_total['total'];


$total_paginas = ceil($total_consultas / $por_pagina);


$query = "SELECT id, data_hora, especialidade FROM consulta LIMIT $inicio, $por_pagina";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&family=Courgette&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

        <!-- Paginação -->
        <nav>
            <ul class="pagination">
                <?php if ($pagina > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>">Anterior</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina < $total_paginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>">Próxima</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybYb3rS3pL2F6d1Ubf3vJrpz5Yb3wVVyLQQvcJ3wYQp6F5+Y8F" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cuF4zx82x+aJ5Ht30/6ZTqPjmEZYgokyQbm1HsX1WBsmXUWh5Ls15TKyTURac7Y+" crossorigin="anonymous"></script>
</body>
</html>
