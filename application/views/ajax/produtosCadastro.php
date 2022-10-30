<script type="text/javascript">
    
    if ($('#codigo_produto').val() != 0) {
        var request = $.ajax({
            url: URL + "buscarProduto",
            method: "POST",
            data: {codigo: $('#codigo_produto').val()},
            dataType: "json",
        });

        request.done(function (res) {
            
            $('#descricao_produto').val(res.data[0].descricao);
            $('#ativo').val(res.data[0].ativo);

//            console.log(res);
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - (buscarProduto) : " + textStatus);
        });
    }
    
    $('#salvarProduto').click(function() {
        console.log('salvar dados');
        
        var request = $.ajax({
            url: URL + "salvarProduto",
            method: "POST",
            data: {
                codigo: $('#codigo_produto').val(),
                descricao_produto: $('#descricao_produto').val(),
                ativo: $('#ativo').val(),
            },
            dataType: "json",
        });

        request.done(function (res) {
//            if (res == true) {
                window.location = URL + 'listagem_produto';
//            }
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - (salvarProduto) : " + textStatus);
        });
    });
</script>

</body>
</html>
