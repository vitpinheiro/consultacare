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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2dRzbdexmZjF3/NW8MbZgsZ3r8g2PVuIuGnDgM3vqHeZ9M5onVKpnIF57r4d" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&family=Courgette&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3 mb-3">Adicionar Consulta</button>
            </div>

        </form>

   
    <div id="editarConsultaForm" style="display: none;">
        <h2>Editar Consulta</h2>
        <form id="editarForm" method="POST" action="editar_consulta.php">
            <div class="form-row ">
                <input type="datetime-local" name="data_hora" class="form-control" placeholder="Data e Hora" required>
                <input type="text" name="especialidade" class="form-control" placeholder="Especialidade" required>
                <input type="hidden" name="paciente_id" value="1"> 
                
                
                <input type="hidden" name="consulta_id" value="">
            </div>
            <button type="submit" class="btn btn-primary mt-2 mb-3">Salvar Alterações</button>
            <button type="button" id="cancelarEdicao" class="btn btn-secondary mt-2 mb-3" style="">Cancelar</button>
        </form>
    </div>

                

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
                                <button class='btn btn-warning btn-sm edit-button' data-consulta-id='{$consulta['id']}' data-data-hora='{$data_formatada}' data-especialidade='{$consulta['especialidade']}'>Editar</button>

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
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybYb3rS3pL2F6d1Ubf3vJrpz5Yb3wVVyLQQvcJ3wYQp6F5+Y8F" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cuF4zx82x+aJ5Ht30/6ZTqPjmEZYgokyQbm1HsX1WBsmXUWh5Ls15TKyTURac7Y+" crossorigin="anonymous"></script>
    <script src="js/admin.js"></script>

</body>
</html>
