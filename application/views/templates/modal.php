<!-- Logout Modal-->
<div class="modal fade" id="abrirChamado" tabindex="-1" role="dialog" aria-labelledby="abrirChamado" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header" style="background-color: #4e73df; color: white; border-top-left-radius: 0; border-top-right-radius: 0;">
                <h5 class="modal-title" id="exampleModalLabel"><span id="titulo-modal"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <span id="conteudo-modal"></span>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="salvar_registro" >Sim</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="visualizarChamado" tabindex="-1" role="dialog" aria-labelledby="visualizarChamado" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #4e73df; color: white; border-top-left-radius: 0; border-top-right-radius: 0;">
                <h5 class="modal-title" id="exampleModalLabel">Visualizar chamado</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" style="font-size: 13px;">
                <div class="table-responsive"> 
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-primary"><b><h4>Dados cliente</b></h4></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b class="text-primary">Cod. Taréfa: </b><span class="codigo_tarefa_modal"></span></td>
                                <td><b class="text-primary">Status: </b><span class="status_tarefa_modal"></span></td>
                                <td><b class="text-primary">Cliente: </b><span class="nome_fantasia_tarefa_modal"></span></td>
                                <td><b class="text-primary">Data: </b> <span class="data_abertura_tarefa_modal"></span></td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td><b class="text-primary">Solicitante: </b><span class="solicitante_tarefa_modal"></span></td>
                                <td><b class="text-primary">Telefone: </b><span class="telefone_fixo_tarefa_modal"></span></td>
                                <td><b class="text-primary">Celular: </b><span class="telefone_celular_tarefa_modal"></span></td>
                                <td><b class="text-primary">Email: </b><span class="email_tarefa_modal"></span></td>
                                <td><b></b></td>
                            </tr>
                            <tr>
                                <td><b class="text-primary">Produto: </b><span class="produto_tarefa_modal"></span></td>
                                <td><b class="text-primary">Componente: </b><span class="componente_tarefa_modal"></span></td>
                                <td><b></b></td>
                                <td><b></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive"> 
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-primary">
                                <th><b><h4>Comentários</b></h4></th>
                            </tr>
                            <tr>
                                <td><b class="text-primary">Assunto: </b> <span class="assunto_tarefa_modal"></span></td>
                            </tr>
                        </thead>
                        <tbody id="comentarios_tarefas">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
