<script type="text/javascript">

    $(function () {

        var table = $('#listagemMarketing').DataTable({
            "ajax": {
                "url": URL + "listagemMarketing",
                "type": "POST",
                "data": function (data) {
                    data.tipoConsulta = $('#tipoConsulta').val()
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
                {"data": "nome"},
                {"data": "cidade"},
                {"data": "telefone_fixo"},
                {"data": "email"},
                {"data": "enviado"},
                {"data": "observacao_envio"},
                {"data": "contato"},
                {"data": "excluir"}
            ]
        });
        table.order( [[ 7, 'asc' ]] ).draw();
        
        $('#tipoConsulta').change(function () {
            table.ajax.url(URL + 'listagemMarketing').load();
        });
    });

    $('#start').click(function () {
        $('#stop_start').val('1');
        console.log('Ligado envio de e-mail');
    });
    $('#stop').click(function () {
        $('#stop_start').val('0');
    });
    var check_session;

    function CheckForSession(codigo) {
        if ((typeof codigo === 'undefined')) {
            codigo = 0;
        }
        if ($('#stop_start').val() == '1' || codigo > 0) {

            var request = $.ajax({
                url: URL + "verificaEenviaEmail",
                method: "POST",
                data: {codigo: codigo},
                dataType: "json",
                cache: false,
            });

            request.done(function (res) {
                if (codigo > 0) {
//                    alert(res.msg);
                    console.log(res);
                }
            });

            request.fail(function (jqXHR, textStatus) {
                console.log("Request failed - CheckForSession: " + textStatus, jqXHR);
            });
        } else {
            console.log('Desligado envio de e-mail');
        }
    }
//$('#tempo').val()
    check_session = setInterval(CheckForSession, $('#tempo').val());
//console.log(check_session);

    function importarArquivos() {
        var arquivo = $("#arquivos");

        var file = $(arquivo)[0].files;

        var formData = new FormData();

        formData.append('file', file[0]);

        var request = $.ajax({
            url: URL + "importarArquivos",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
        });

        request.done(function (arquivos) {
            if (arquivos > 0) {
                location.reload();
                alert('Arquivo importado');
            }
            console.log(arquivos);
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - importarArquivos: " + textStatus);
        });
    }
    
    function excluirMarketing(codigo) {
        var request = $.ajax({
            url: URL + "excluirMarketing",
            method: "POST",
            data: {codigoMarketing: codigo},
            dataType: "json",
            cache: false,
        });

        request.done(function (res) {
            alert('Excluido com sucesso!');
//            location.reload();
        });

        request.fail(function (jqXHR, textStatus) {
            console.log("Request failed - CheckForSession: " + textStatus, jqXHR);
        });
    }
    function alterarStatus(status,codigo) {
        var request = $.ajax({
            url: URL + "alterarStatus",
            method: "POST",
            data: {codigoMarketing: codigo, status: status},
            dataType: "json",
            cache: false,
        });

        request.done(function (res) {
//            alert('Alterado com sucesso!');
            console.log(res);
//            location.reload();
        });

        request.fail(function (jqXHR, textStatus) {
            console.log("Request failed - CheckForSession: " + textStatus, jqXHR);
        });
    }

</script>

</body>
</html>
