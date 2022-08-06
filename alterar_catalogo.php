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


$catalogo = $_POST['pecadetalhe'];

foreach( $catalogo as $result ){
    $id = $result['id'];
    $status = $result['status'];
    
    if ($status == '')
    continue;

 $salvar = "UPDATE `catalogo` SET `status` = '$status', `updated_at_user` = '$usuario_at', `updated_at` = '$datahora'  WHERE `catalogo`.`id` = '$id'";

 $_salvar = mysqli_query($conexao, $salvar);

}

 if ($_salvar == 1) {
    ?>
    
        <form action="catalogo.php" method="POST">
    
        <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">Salvo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>Alteração realizada com sucesso&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
           
        </form>
        <script>
            var senha = 0;
    
            if (senha != 1) {
                $('#modal-primary').modal('show');
            }
        </script>
        </form>
    <?php
        echo '<meta http-equiv="refresh" content="3;URL=catalogo.php?"/>';

        exit();
    } else {
    ?>
    
        <form action="catalogo.php" method="POST">
    
        <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Erro</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p> Não foi possível salvar&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
        </form>
        <script>
            var senha = 0;
    
            if (senha != 1) {
                $('#modal-danger').modal('show');
            }
        </script>
    <?php
    
    }
    

?>