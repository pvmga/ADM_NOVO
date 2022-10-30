<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cadastrar Chamados</h1>
    </div>

    <div class="row">
        <div class="col-lg-1">
            <div class="form-group input-group-sm">
                <label>Id: <span style="color: red;">*</span></label>
                <input class="form-control" id="codigo_chamado" value="<?= $this->uri->segment('2') ?>" disabled>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Contato: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="contato_chamado" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group input-group-sm">
                <label>Empresa: <span style="color: red;">*</span></label>
                <select class="form-control select2Empresa" id="select2Empresa">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Técnico: <span style="color: red;">*</span></label>
                <select class="form-control select2Tecnico" id="select2Tecnico">
                    <option value="">Selecione...</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Status: <span style="color: red;">*</span></label>
                <select class="form-control select2Status" id="status_chamado">
                    <option value="">Selecione...</option>
                    <option value="Aguardando">AGUARDANDO</option>
                    <option value="Confirmado">CONFIRMADO</option>
                    <option value="Em progresso">EM PROGRESSO</option>
                    <option value="Finalizado">FINALIZADO</option>
                    <option value="Atualizar">ATUALIZAR</option>
                    <option value="Resolvido">RESOLVIDO</option>
                    <option value="Desenvolvimento">DESENVOLVIMENTO</option>
                    <option value="Suspenso">SUSPENSO</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Prioridade: <span style="color: red;">*</span></label>
                <select class="form-control select2Prioridade" id="prioridade_chamado">
                    <option value="Muito baixa">MUITO BAIXA</option>
                    <option value="Baixa">BAIXA</option>
                    <option value="Normal">NORMAL</option>
                    <option value="Alta">ALTA</option>
                    <option value="Muito alta">MUITO ALTA</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group input-group-sm">
                <label>Assunto: <span style="color: red;">*</span></label>
                <input class="form-control" id="assunto_chamado" value="">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Produto: <span style="color: red;">*</span></label>
                <select class="form-control select2Produto" id="select2Produto">
                    <option value="">Selecione...</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group input-group-sm">
                <label>Componente: <span style="color: red;">*</span></label>
                <select class="form-control select2Componente" id="select2Componente">
                    <option value="">Selecione...</option>
                </select>
            </div>
        </div>


<!--        <div class="modal fade" id="myModalImagens" tabindex="-1" role="dialog" aria-labelledby="myModalImagens" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #4e73df; color: white; border-top-left-radius: 0; border-top-right-radius: 0;">
                        <h5 class="modal-title" id="exampleModalLabel">Visualizar chamado</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <span id="modalImagens"></span>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>-->

        <div class="col-lg-3">
            <div class="form-group input-group-sm">
                <label>Arquivo(s): <span id="status"></span><a href="#" data-toggle="modal" data-target="#myModalImagens" id="visualizar" style="text-decoration: none;"></a></label>
                <br />
                <div class="fileUpload btn btn-primary btn-sm">
                    Selecionar<input type="file" class="form-control upload" name="arquivos" id="arquivos" onblur="mostrarQuantidade()" multiple />
                </div>
                <!--<a class="btn btn-primary btn-sm" href="#">Enviar</a>-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Comentário: </label>
                <textarea class="form-control" name="observacao_chamado" cols="40" rows="5" placeholder="Observação" name="observacao_chamado" id="observacao_chamado" ></textarea>
            </div>
        </div>
    </div>

    <div class="row text-right">
        <div class="col-lg-12">
            <button class="btn btn-primary" id="salvarChamado" type="button">Salvar</button>
            <a href="<?= base_url('chamado_listagem'); ?>" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>
    <br />
    <div class="row alert-info">
        <div class="table-responsive"> 
            <table class="table table-hover">
                <thead>
                    <tr class="text-primary">
                        <th><b><h4>Comentários</b></h4></th>
                    </tr>
                </thead>
                <tbody id="comentarios_tarefas">
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
