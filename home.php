<?php
require_once('valida_session.php');
require_once('header.php');
require_once('sidebar.php');
require_once("bd/bd_ordem.php");
?>

<!-- Main Content -->
<div id="content">
 <?php require_once('navbar.php');?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Ordens de Serviço Abertas -->
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Ordens de Serviço Abertas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $status_aberto = 1;
                                switch ($_SESSION['perfil']) {
                                    case 1:
                                        // Usuário
                                        $total = consultaStatusUsuario($status_aberto);
                                        break;
                                    case 2:
                                        // Cliente
                                        $total = consultaStatusCliente($_SESSION['cod_usu'], $status_aberto);
                                        break;
                                    case 3:
                                        // Terceirizado
                                        $total = consultaStatusTerceirizado($_SESSION['cod_usu'], $status_aberto);
                                        break;
                                    default:
                                        $total = ['total' => 0];
                                }
                                echo isset($total['total']) ? $total['total'] : '0';
                            ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ordens de Serviço em Execução -->
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Ordens de Serviço em Execução</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $status_execucao = 2;
                                switch ($_SESSION['perfil']) {
                                    case 1:
                                        // Usuário
                                        $total = consultaStatusUsuario($status_execucao);
                                        break;
                                    case 2:
                                        // Cliente
                                        $total = consultaStatusCliente($_SESSION['cod_usu'], $status_execucao);
                                        break;
                                    case 3:
                                        // Terceirizado
                                        $total = consultaStatusTerceirizado($_SESSION['cod_usu'], $status_execucao);
                                        break;
                                    default:
                                        $total = ['total' => 0];
                                }
                                echo isset($total['total']) ? $total['total'] : '0';
                            ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ordens de Serviço Concluídas -->
        <div class="col-xl-3 col-md-6 mb-4" id="cards-notice">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Ordens de Serviço Concluídas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                                $status_concluida = 3;
                                switch ($_SESSION['perfil']) {
                                    case 1:
                                        // Usuário
                                        $total = consultaStatusUsuario($status_concluida);
                                        break;
                                    case 2:
                                        // Cliente
                                        $total = consultaStatusCliente($_SESSION['cod_usu'], $status_concluida);
                                        break;
                                    case 3:
                                        // Terceirizado
                                        $total = consultaStatusTerceirizado($_SESSION['cod_usu'], $status_concluida);
                                        break;
                                    default:
                                        $total = ['total' => 0];
                                }
                                echo isset($total['total']) ? $total['total'] : '0';
                            ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>

<?php
require_once('footer.php');
?>
