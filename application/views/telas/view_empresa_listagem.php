<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listagem de Empresas</h1>
        <a href="<?= base_url('formulario_cadastro_empresa/0'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Cadastrar Empresa
        </a>
    </div>

    <!-- TABLE -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Empresas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="font-size: 13px;">
                <table class="table table-bordered" id="listagemEmpresa" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fantasia</th>
                            <th>Social</th>
                            <th>Telefone</th>
                            <th>Cidade</th>
                            <th>NFCE</th>
                            <th>Responsavel</th>
                            <th>Contato</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Fantasia</th>
                            <th>Social</th>
                            <th>Telefone</th>
                            <th>Cidade</th>
                            <th>NFCE</th>
                            <th>Responsavel</th>
                            <th>Contato</th>
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
