<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cadastrar Empresa</h1>
    </div>

    <div class="row">
        <div class="col-lg-1">
            <div class="form-group input-group-sm">
                <label>Id: <span style="color: red;">*</span></label>
                <input class="form-control" id="codigo_empresa" value="<?= $this->uri->segment('2') ?>" disabled>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group input-group-sm">
                <label>Razão social: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="razao_social" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group input-group-sm">
                <label>Nome fantasia: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="nome_fantasia" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group input-group-sm">
                <label>CNPJ: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="cnpj" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Inscrição estadual: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="inscricao" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>

        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Responsável: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="responsavel" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group input-group-sm">
                <label>E-mail: </label>
                <input class="form-control input-lg small" id="email" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Cidade: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="cidade" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Telefone celular: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="telefone_celular" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm">
                <label>Telefone fixo: <span style="color: red;">*</span></label>
                <input class="form-control input-lg small" id="telefone_fixo" placeholder="" value="" maxlength="50" required="required">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group input-group-sm" disabled="">
                <label>Contato: </label>
                <select name="contato" class="form-control input-sm" id="contato">
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group input-group-sm">
                <label>Motivo: </label>
                <input class="form-control input-lg small" id="motivo" placeholder="" value="" maxlength="50" required="required">
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
        
        <div class="col-lg-1 col-sm-1 col-md-1">
            <label>NFC-e: </label>
            <div class="checkbox">
                <label>											    	
                    <input type="checkbox" name="nfce" id="nfce" value="true"> Sim
                </label>
            </div>
        </div>
        <div class="col-lg-1 col-sm-1 col-md-1">
            <label>CT-e: </label>
            <div class="checkbox">
                <label>											    	
                    <input type="checkbox" name="cte" id="cte" value="true"> Sim
                </label>
            </div>
        </div>
        <div class="col-lg-1 col-sm-1 col-md-1">
            <label>MDF-e: </label>
            <div class="checkbox">
                <label>											    	
                    <input type="checkbox" name="mdfe" id="mdfe" value="true"> Sim
                </label>
            </div>
        </div>
    </div>

    <div class="row"></div>

    <div class="row text-right">
        <div class="col-lg-12">
            <button class="btn btn-primary" id="salvarEmpresa" type="button">Salvar</button>
            <a href="<?= base_url('listagem_empresa'); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
