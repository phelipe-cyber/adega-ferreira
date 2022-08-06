<?php
error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
include('header_novo.php');
include('conexao.php');
// include('Header_CSS_JS.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario = $_SESSION['usuario'];

$produto = $_POST['pecadetalhe'];

// print_r($_POST);


foreach( $produto as $result ){
    $preco = $result['preco'];
    $mesa = $result['mesa'];
    $qtde = $result['qtde'];
    $descricao = $result['descricao'];
    $pedido = $result['pedido'];
    $nomecliente = $result['nome_cliente'];
    $id_excluir = $result['id'];


 $update ="UPDATE `pedidos_realizados` SET  `total_pedido` = '$qtde', updated_at_user = '$usuario', updated_at = '$datahora'  WHERE `pedidos_realizados`.`id` = '$id_excluir'";

// echo "<br>";
// echo $update;
// echo "<br>";

 $salve = mysqli_query($conexao, $update);
}
if ($salve == 1) {
    ?>
    
    <form action="pedido.php" method="POST">
    
    <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">Excluido</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>Excluido com sucesso&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
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

    <?php
        echo '<meta http-equiv="refresh" content="3;URL=pedido.php?"/>';
        exit();
    } else {
    ?>
    
        <form action="pedido.php" method="POST">
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
              <p> Não foi possível exluir o item&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-outline-light" data-dismiss="modal">Fechar</button>
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