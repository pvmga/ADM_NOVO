<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10" style="margin-top: 50px; margin-bottom: -20px; margin-left: 400px;">

                <img src="http://ingasoft.com.br/adm/imagens/logo/logo - Cópia.png" alt="logo ingasoft" width="500" />

            </div>
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                            <!--<div class="col-lg-6 d-none d-lg-block"></div>-->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <hr>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                                    </div>
                                    <div class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="emailLogin" aria-describedby="emailLogin" placeholder="Ensira o endereço de e-mail..." autofocus="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="senhaLogin" placeholder="Senha">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" id="btn-valida-login">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span class="text-white">Copyright &copy; INGASOFT <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('template/'); ?>vendor/jquery/jquery.min.js"></script>
