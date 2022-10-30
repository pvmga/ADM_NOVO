<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listagem</h1>
        <div class="fileUpload btn btn-primary btn-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Importar<input type="file" class="form-control upload" name="arquivos" id="arquivos" onchange="importarArquivos();" />
        </div>
    </div>

    <!-- TABLE -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">E-mails</h6>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group input-group-sm">
                        <label>Contato</label>
                        <select class="form-control tipoConsulta" id="tipoConsulta">
                            <option value="N">Não</option>
                            <option value="S">Sim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6"></div>
                <div class="col-lg-1">
                    <input class="form-control" id="tempo" value="100000" />
                </div>
                <div class="col-lg-1">
                    <input class="form-control" id="stop_start" value="0" />
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary" id="start" type="button">Iniciar</button>
                    <button class="btn btn-danger" id="stop" type="button">Parar</button>
                </div>
            </div>

            <div class="table-responsive" style="font-size: 13px;">
                <table class="table table-bordered" id="listagemMarketing" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 15%">Nome</th>
                            <th>Cidade</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Enviado</th>
                            <th>Obs</th>
                            <th>Contato</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 10%">Nome</th>
                            <th>Cidade</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Enviado</th>
                            <th>Obs</th>
                            <th>Contato</th>
                            <th style="width: 10%;"></th>
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
