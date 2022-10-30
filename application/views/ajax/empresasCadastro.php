<script type="text/javascript">
   
    if ($('#codigo_empresa').val() != 0) {
        var request = $.ajax({
            url: URL + "listagemEmpresa",
            method: "GET",
            data: {q: $('#codigo_empresa').val()},
            dataType: "json",
        });

        request.done(function (res) {
            console.log(res['data'][0]);
            $('#razao_social').val(res['data'][0]['razao_social']);
            $('#nome_fantasia').val(res['data'][0]['nome_fantasia']);
            $('#cnpj').val(res['data'][0]['cnpj']);
            $('#inscricao').val(res['data'][0]['inscricao']);
            $('#responsavel').val(res['data'][0]['responsavel']);
            $('#email').val(res['data'][0]['email']);
            $('#cidade').val(res['data'][0]['cidade']);
            $('#telefone_celular').val(res['data'][0]['telefone_celular']);
            $('#telefone_fixo').val(res['data'][0]['telefone_fixo']);
            $('#motivo').val(res['data'][0]['motivo']);
            $('#contato').val(res['data'][0]['contato']);
            
            if (res['data'][0]['nfce'] === '1') {
                $('#nfce').attr('checked', 'checked');
            }
            if (res['data'][0]['cte'] === '1') {
                $('#cte').attr('checked', 'checked');
            }
            if (res['data'][0]['mdfe'] === '1') {
                $('#mdfe').attr('checked', 'checked');
            }
            
            $('#ativo').val(res['data'][0]['ativo']);
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - buscarEmpresaModal : " + textStatus);
        });
    }
    
    $('#salvarEmpresa').click(function() {
        var request = $.ajax({
            url: URL + "inserirEmpresa",
            method: "POST",
            data: {
                codigo: $('#codigo_empresa').val(),
                razao_social: $('#razao_social').val(),
                nome_fantasia: $('#nome_fantasia').val(),
                cnpj: $('#cnpj').val(),
                inscricao: $('#inscricao').val(),
                responsavel: $('#responsavel').val(),
                email: $("#email").val(),
                cidade: $('#cidade').val(),
                telefone_celular: $('#telefone_celular').val(),
                telefone_fixo: $('#telefone_fixo').val(),
                motivo: $('#motivo').val(),
                ativo: $('#ativo').val(),
                contato: $('#contato').val(),
                nfce: document.getElementById('nfce').checked,
                cte: document.getElementById('cte').checked,
                mdfe: document.getElementById('mdfe').checked,
            },
            dataType: "json",
        });

        request.done(function (res) {
            if (res == true) {
                window.location = URL + 'listagem_empresa';
            }
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - inserirEmpresa : " + textStatus);
        });
    });

</script>

</body>
</html>
