<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listagem de Chamados</h1>
        <a href="<?= base_url('formulario_cadastro/0'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Abrir chamado
        </a>
    </div>

    <!-- TABLE -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                <div class="col-md-3">
                    <div class="form-group ">
                        <input id="codigo-tecnico-select2" value="<?= $this->session->userdata('codigo'); ?>" hidden="" />
                        <input id="nome-tecnico-select2" value="<?= $this->session->userdata('nome'); ?>" hidden="" />
                        <select class="form-control select2Tecnico" id="select2Tecnico">
                            <option value="<?= $this->session->userdata('nome'); ?>"><?= $this->session->userdata('nome'); ?></option>
                            <option value="TODOS">TODOS</option>
                        </select>
                    </div>
                </div>
            </div>
            <h6 class="m-0 font-weight-bold text-primary">Chamados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="font-size: 13px;">
                <table class="table table-bordered" id="listagemChamados" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tarefa</th>
                            <th>Fantasia</th>
                            <th>Assunto</th>
                            <!--<th>Lançado</th>-->
                            <th>Responsável</th>
                            <th>Produto</th>
                            <th>Componente</th>
                            <th>Solicitante</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tarefa</th>
                            <th>Fantasia</th>
                            <th>Assunto</th>
                            <!--<th>Lançado</th>-->
                            <th>Responsável</th>
                            <th>Produto</th>
                            <th>Componente</th>
                            <th>Solicitante</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /TABLE -->

</div>
<!-- /.container-fluid -->


