<?php
// session_start();
error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
include('conexao.php');
include('header_novo.php');
include('Header_CSS_JS.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario_at = $_SESSION['usuario'];
$qtd = 0;
$id_status = 2;


$usuario = $_POST['pecadetalhe'];

foreach( $usuario as $result ){
    $id = $result['id'];
    $status = $result['status'];
    
    if ($status == '')
    continue;

 $salvar = "UPDATE `user` SET `status` = '$status', `updated_at_user` = '$usuario_at', `updated_at` = '$datahora'  WHERE `user`.`id` = '$id'";
$_salvar = mysqli_query($conexao, $salvar);

}

 if ($_salvar == 1) {
    ?>
    
        <form action="usuarios.php" method="POST">
    
            <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Salvo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <div class="alert alert-primary text-center " role="alert">
                                    <h1> <b> Alteração feita com sucesso </b>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            var senha = 0;
    
            if (senha != 1) {
                $('#modalSubscriptionForm').modal('show');
            }
        </script>
    <?php
        exit();
    } else {
    ?>
    
        <form action="usuarios.php" method="POST">
    
            <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Erro</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <div class="alert alert-danger text-center " role="alert">
                                    <h1> <b> Erro na alteração </b>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            var senha = 0;
    
            if (senha != 1) {
                $('#modalSubscriptionForm').modal('show');
            }
        </script>
    <?php
    
    }
    

?>