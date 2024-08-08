<?php
session_start();
require_once('header.php'); 
include_once('./apis/viacep/viacep.php');
?>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Crie sua Conta!</h1>
                                    </div>
                                    <?php if (isset($_SESSION['texto_erro_cadastro'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro_cadastro'] ?></strong> 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php unset($_SESSION['texto_erro_cadastro']); ?>
                                    <?php endif; ?>
                                    <form class="user" action="valida_cadastro.php" method="post">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Nome Completo</label>
                                                <input type="text" class="form-control form-control-user" id="nome" name="nome" placeholder="Nome Completo" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Email</label>
                                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Endereço de Email" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Senha</label>
                                                <input type="password" class="form-control form-control-user" id="senha" name="senha" placeholder="Senha" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Confirmar Senha</label>
                                                <input type="password" class="form-control form-control-user" id="confirma_senha" name="confirma_senha" placeholder="Confirmar Senha" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>CEP</label>
                                                <input type="text" class="form-control form-control-user" id="cep" name="cep" placeholder="CEP" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Endereço</label>
                                                <input type="text" class="form-control form-control-user" id="endereco" name="endereco" placeholder="Endereço" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Número</label>
                                                <input type="number" class="form-control form-control-user" id="numero" name="numero" placeholder="Número" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Bairro</label>
                                                <input type="text" class="form-control form-control-user" id="bairro" name="bairro" placeholder="Bairro" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Cidade</label>
                                                <input type="text" class="form-control form-control-user" id="cidade" name="cidade" placeholder="Cidade" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>UF</label>
                                                <input type="text" class="form-control form-control-user" id="uf" name="uf" placeholder="UF" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Telefone</label>
                                                <input type="tel" class="form-control form-control-user" id="telefone" name="telefone" placeholder="Telefone" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Cadastrar
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Já tem uma conta? Faça login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src='./apis/viacep/viacep.js'></script>
</body>
</html>