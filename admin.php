<!DOCTYPE html>
<html lang="en">
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
        
        <form action="../actions/create_consulta.php" method="POST" class="mb-4">
            <div class="form-row">
                <input type="datetime-local" name="data_hora" class="form-control" placeholder="Data e Hora" required>
                <input type="text" name="especialidade" class="form-control" placeholder="Especialidade" required>
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
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2025-01-27 14:30</td>
                    <td>Cardiologia</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Editar</button>
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2025-02-03 10:00</td>
                    <td>Dermatologia</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Editar</button>
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2025-02-10 16:45</td>
                    <td>Ortopedia</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Editar</button>
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybYb3rS3pL2F6d1Ubf3vJrpz5Yb3wVVyLQQvcJ3wYQp6F5+Y8F" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cuF4zx82x+aJ5Ht30/6ZTqPjmEZYgokyQbm1HsX1WBsmXUWh5Ls15TKyTURac7Y+" crossorigin="anonymous"></script>
</body>
</html>
