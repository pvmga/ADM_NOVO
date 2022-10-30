<script type="text/javascript">

    $(function () {
        $(".select2Status").select2();
        $(".select2Prioridade").select2();
//        $(".select2Componente").select2();

        listaEmpresa()
        function listaEmpresa() {
            $(".select2Empresa").select2({
                ajax: {
                    url: URL + "listagemEmpresa",
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

                var markup = '<div>' + repo.nome_fantasia + '</div>';

                return markup;
            }

            function formatRepoSelection(repo) {
                return '<option value="' + repo.id + '" id="alterado_empresa">' + repo.nome_fantasia + '</option>';
            }
        }
        $('#alterado_empresa').text('Selecione...');

        listaTecnico()
        function listaTecnico() {
            $(".select2Tecnico").select2({
                ajax: {
                    url: URL + "listagemTecnico",
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

                var markup = '<div>' + repo.nome + '</div>';

                return markup;
            }

            function formatRepoSelection(repo) {
                return '<option value="' + repo.id + '" id="alterado_tecnico">' + repo.nome + '</option>';
            }
        }
        $('#alterado_tecnico').text('Selecione...');

        listaProduto()
        function listaProduto() {
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
        }
        $('#alterado_produto').text('Selecione...');
        
        $('.select2Componente').select2();
        
        $('#select2Produto').change(function () {
            if ($(this).val() != 0) {
                $('#select2Componente').hide();
                //$('.carregando').show(50);
                $.getJSON(URL + 'listagemComponente?search=', {id_produto: $(this).val(), ajax: 'true'}, function (j) {
                    var options = '<option value="">Escolha Subcategoria</option>';

                    for (var i = 0; i < j['data'].length; i++) {
                        options += '<option value="' + j['data'][i].id + '">' + j['data'][i].descricao + '</option>';
                    }
                    $('#select2Componente').html(options).show();
                    //$('.carregando').hide(50);
                });
            } else {
                $('#select2Componente').html('<option value="">– Escolha o componente –</option>');
            }
        });

    });
    $('#alterado_chamado').text('Selecione...');
    
    if ($('#codigo_chamado').val() != 0) {
        var request = $.ajax({
            url: URL + "buscarChamadoModal",
            method: "POST",
            data: {codigo: $('#codigo_chamado').val()},
            dataType: "json",
        });

        request.done(function (res) {

            $('#contato_chamado').val(res[0]['solicitante']);
            
            $(".select2Empresa option:selected").val(res[0]['cod_empresa']);
            $("#alterado_empresa").text(res[0]['nome_fantasia']);

            $(".select2Tecnico option:selected").val(res[0]['cod_tecnico']);
            $("#alterado_tecnico").text(res[0]['nome_tecnico']);
            
            $('#status_chamado').val(res[0]['nome_status']);
//            $(".select2Status option:selected").val(res[0]['nome_status']);
            $('#select2-status_chamado-container').text(res[0]['nome_status'].toUpperCase());
            
            $('#prioridade_chamado').val(res[0]['prioridade']);
            $('#select2-prioridade_chamado-container').text(res[0]['prioridade'].toUpperCase());
            
            $('#assunto_chamado').val(res[0]['assunto']);

            $(".select2Produto option:selected").val(res[0]['cod_produto']);
            $("#alterado_produto").text(res[0]['nome_produto']);
            
            $(".select2Componente option:selected").val(res[0]['cod_componente']);
            $('#select2Componente').html('<option value="'+res[0]['cod_componente']+'">'+res[0]['nome_componente']+'</option>');
            
            $.each(res, function (key, value) {
                $('#comentarios_tarefas').append("\
                    <tr>\
                        <td><b class='text-primary'>" + value['tecnico_alt'] + ": " + value['data_registro'] + " - " + value['status'] + "</b><br />\
                            <p><b class='text-danger'>Arquivos: <a href='"+URL+'files/'+value['arquivo']+"' target='_blank'>"+value['arquivo_original']+"</a> | <a href='"+URL+'files/'+value['arquivo2']+"' target='_blank'>"+value['arquivo_original2']+"</a> | <a href='"+URL+'files/'+value['arquivo3']+"' target='_blank'>"+value['arquivo_original3']+"</a> | <a href='"+URL+'files/'+value['arquivo4']+"' target='_blank'>"+value['arquivo_original4']+"</a> | <a href='"+URL+'files/'+value['arquivo5']+"' target='_blank'>"+value['arquivo_original5']+"</a> | <a href='"+URL+'files/'+value['arquivo6']+"' target='_blank'>"+value['arquivo_original6']+"</a> | <a href='"+URL+'files/'+value['arquivo7']+"' target='_blank'>"+value['arquivo_original7']+"</a> | <a href='"+URL+'files/'+value['arquivo8']+"' target='_blank'>"+value['arquivo_original8']+"</a> | <a href='"+URL+'files/'+value['arquivo9']+"' target='_blank'>"+value['arquivo_original9']+"</a> | <a href='"+URL+'files/'+value['arquivo10']+"' target='_blank'>"+value['arquivo_original10']+"</a></b><br >\
                            <span>" + value['mensagem'] + "</span>\
                        </td>\
                    </tr>");
            });
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - buscarChamadoModal : " + textStatus);
        });
    }

    function mostrarQuantidade() {
        var arquivo = $("#arquivos");
        var status = $("#status");
        var modalImagens = $("#modalImagens");
        var visualizar = $("#visualizar");

        status.html("");

        var file = $(arquivo)[0].files;
        var count = 0;
        var imagens = '';

        for (var i = 0; i < file.length; i++) {
            count = count + 1;
            imagens += file[i].name + '<br />';
        }

        if (count > 0 && count <= 10) {
            status.css('color', 'green');
            status.html(' ' + count);
            visualizar.html(' Visualizar');
            modalImagens.html(imagens);

            /*botão de enviar imagens false(deixa habilitado para enviar)*/
            $('.btnDisabled').attr('disabled', false);
        } else {
            if (count >= 10) {
                status.css('color', 'red');
                status.html(' Permitido no máximo 10 arquivos!');

                /*botão de enviar imagens false(deixa habilitado para enviar)*/
                $('.btnDisabled').attr('disabled', true);
                arquivo.val("");
            }
        }
    }

    $('#salvarChamado').click(function () {
//        $('#abrirChamado').modal('show');
//        document.getElementById('titulo-modal').textContent = 'Salvar chamado';
//        document.getElementById('conteudo-modal').textContent = 'Deseja realmente gravar ?';
        salvar_registro();
    });
    function salvar_registro() {
//    $('#salvar_registro').click(function () {
        var arquivo = $("#arquivos");

        var file = $(arquivo)[0].files;

        var formData = new FormData();

        // para funcionar upload precisei alterar o php.ini
        //upload_max_filesize=2M
        for (var i = 0; i < file.length; i++) {
            formData.append('file[]', file[i]);
        }

        //formData.append( 'file' , file[i] );
        var request = $.ajax({
            url: URL + "uploadArquivos",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        });

        request.done(function (arquivos) {
//            console.log(arquivos);
            salvarChamado(arquivos)
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - uploadArquivos: " + textStatus);
        });
//    });
    }

    function salvarChamado(arquivos) {

        var dados = {
            codigo_chamado: $('#codigo_chamado').val(),
            nome: $('#contato_chamado').val(),
            cod_empresa: $('.select2Empresa option:selected').val(),
            cod_tecnico: $('.select2Tecnico option:selected').val(),
            nome_status: $('#status_chamado option:selected').val(),
            prioridade: $('#prioridade_chamado option:selected').val(),
            assunto: $('#assunto_chamado').val(),
            cod_produto: $('.select2Produto option:selected').val(),
            cod_componente: $('#select2Componente').val(),
            mensagem: document.getElementById('observacao_chamado').value,
            arquivos: arquivos,
        }

        var request = $.ajax({
            url: URL + "salvarChamado",
            method: "POST",
            data: {dados: dados},
            dataType: "json",
        });

        request.done(function (msg) {
            if (msg > 0) {
//                alert('Chamado inserido.');
                if (document.getElementById('observacao_chamado').value != '') {
                    enviarEmail(msg);
                }
                window.location = URL + 'chamado_listagem';
            } else {
                alert('Não gerou número de chamado, tente salvar novamente ou entre em contato com o suporte.');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR, textStatus);
            alert("Request failed - salvarChamado : " + textStatus);
        });
    }

    function enviarEmail(cod_tarefa) {

        var request = $.ajax({
            url: URL + "enviarEmailChamado",
            method: "POST",
            data: {cod_tarefa: cod_tarefa},
            dataType: "json",
        });

        request.done(function (msg) {
            console.log(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            console.log(jqXHR);
            console.log("Request failed - (enviarEmailChamado) : "+textStatus);
        });

    }

</script>

</body>
</html>
