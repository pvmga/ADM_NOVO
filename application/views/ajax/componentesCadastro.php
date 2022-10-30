<script type="text/javascript">
    
    $(".select2Produto").select2({
        ajax: {
            url: URL + "listagemProduto",
            dataType: 'json',
            delay: 300,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        minimumInputLength: 0,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var markup = '<div>' + repo.descricao + '</div>';

        return markup;
    }

    function formatRepoSelection(repo) {
        return '<option value="' + repo.id + '" id="alterado_produto">' + repo.descricao + '</option>';
    }
    $('#alterado_produto').text('Selecione...');
    
    if ($('#codigo_componente').val() != 0) {
        var request = $.ajax({
            url: URL + "buscarComponente",
            method: "POST",
            data: {codigo: $('#codigo_componente').val()},
            dataType: "json",
        });

        request.done(function (res) {
            
            $('#descricao_componente').val(res.data[0].descricao);
            $('#ativo').val(res.data[0].ativo);

            $(".select2Produto option:selected").val(res.data[0]['cod_produto']);
            $("#alterado_produto").text(res.data[0]['descricao_produto']);
//            console.log(res);
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - (buscarComponente) : " + textStatus);
        });
    }
    
    $('#salvarComponente').click(function() {
        console.log('salvar dados');
        
        var request = $.ajax({
            url: URL + "salvarComponente",
            method: "POST",
            data: {
                codigo: $('#codigo_componente').val(),
                descricao_componente: $('#descricao_componente').val(),
                ativo: $('#ativo').val(),
                select2Produto: $('#select2Produto').val()
            },
            dataType: "json",
        });

        request.done(function (res) {
//            if (res == true) {
                window.location = URL + 'listagem_componente';
//            }
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - (salvarComponente) : " + textStatus);
        });
    });
</script>

</body>
</html>
