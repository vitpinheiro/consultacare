        // Função para adicionar consulta
        document.getElementById('consultaForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch('create_consulta.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Consulta adicionada com sucesso!');
                    document.getElementById('consultaForm').reset();
                } else {
                    alert('Erro ao adicionar consulta: ' + data.message);
                }
            })
            .catch(error => {
                alert('Erro na requisição: ' + error);
            });
        });

        // Função para excluir consulta
        function excluirConsulta(consultaId) {
            if (confirm("Tem certeza que deseja excluir essa consulta?")) {
                var formData = new FormData();
                formData.append("consulta_id", consultaId);

                fetch('delete_consulta.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Consulta excluída com sucesso!");
                        // Remover a linha da tabela
                        var row = document.getElementById('consulta_' + consultaId);
                        if (row) {
                            row.remove();
                        } else {
                            console.error('Linha não encontrada para exclusão');
                        }
                    } else {
                        alert("Erro ao excluir consulta: " + data.message);
                    }
                })
                .catch(error => {
                    alert("Erro na requisição: " + error);
                });
            }
        }

        
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function() {
                var consultaId = this.dataset.consultaId;
                excluirConsulta(consultaId);
            });
        });

        


        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-button');
            const editarForm = document.getElementById('editarConsultaForm');
            const editarFormInputs = editarForm.querySelectorAll('input');
            const cancelarEdicaoButton = document.getElementById('cancelarEdicao');
            
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const consultaId = button.getAttribute('data-consulta-id');
                    const dataHora = button.getAttribute('data-data-hora');
                    const especialidade = button.getAttribute('data-especialidade');
                    
                    
                    editarForm.querySelector('[name="data_hora"]').value = dataHora; 
                    editarForm.querySelector('[name="especialidade"]').value = especialidade;
                    editarForm.querySelector('[name="consulta_id"]').value = consultaId;
                    
                    
                    editarForm.style.display = 'block';
                });
            });
            
            
            cancelarEdicaoButton.addEventListener('click', function() {
                editarForm.style.display = 'none'; 
            });
        });
        