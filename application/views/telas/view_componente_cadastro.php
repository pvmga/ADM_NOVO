<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cadastrar Componente</h1>
    </div>

    <div class="row">
        <div class="col-lg-1">
            <div class="form-group input-group-sm">
                <label>Id: </label>
                <input class="form-control" id="codigo_componente" value="<?= $this->uri->segment('2') ?>" disabled>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group input-group-sm">
                <label>Descricação componente: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="descricao_componente" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group input-group-sm">
                <label>Produto: <span style="color: red;">*</span></label>
                <select class="form-control select2Produto" id="select2Produto">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Ativar/Inativar: </label>
                <select name="ativo" id="ativo" class="form-control input-sm">
                    <option value="S">Ativo</option>
                    <option value="N">Inativo</option>
                </select>
            </div>
        </div>
        
    </div>

    <div class="row"></div>

    <div class="row text-right">
        <div class="col-lg-12">
            <button class="btn btn-primary" id="salvarComponente" type="button">Salvar</button>
            <a href="<?= base_url('listagem_componente'); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
