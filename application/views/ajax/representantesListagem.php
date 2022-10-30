<script type="text/javascript">
    $(function () {

        var table = $('#listagemRepresentante').DataTable({
            "ajax": {
                "url": URL + "listagemRepresentante",
                "type": "POST",
                "data": function (data) {
                    data.tecnico = 1
                },
            },
            "cache": true,
            "processing": true,
            "language": {
                "sEmptyTable": "Clique em filtrar e aguarde alguns segundos...",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sLoadingRecords": "Carregando ...",
                "sProcessing": "Aguarde, estamos preparando os dados...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisa rápida",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "nome"},
                {"data": "email"},
                {"data": "telefone_celular"},
                {"data": "alterar"},
                {"data": "excluir"},
            ]
        });
        table.order([[0, 'asc']]).draw();
    });
</script>

</body>
</html>
