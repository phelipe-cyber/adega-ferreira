<?php
error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
include('header_novo.php');
// include('Header_CSS_JS.php');
include('conexao.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario = $_SESSION['usuario'];

$produto = $_POST['pecadetalhe'];

 //print_r($_POST);

$pedido = $_POST['pedido_novo'];
$nomecliente = $_POST['nome_cliente'];




foreach ($produto as $result) {
  $preco = $result['preco'];
  $mesa = $result['mesa'];
  $qtde = $result['qtde'];
  $descricao = $result['descricao'];
  $qtdeestoque = $result['qtde_estoque'];

  $atualestoque = $qtdeestoque - $qtde;

  // $pedido = $result['pedido'];
  // $nomecliente = $result['nome_cliente'];

  if ($qtde == '0')
    continue;

  $inserir = "INSERT INTO `pedidos_realizados`(`id`, `cliente`, `id_pedido`, `descricao_pedido`, 
    `valor_pedido`, `mesa_pedido`, `status_pedido`, `forma_pagamento`,`updated_at_user`, 
    `updated_at`, `total_pedido`, `created_user`, `created_date`) VALUES

    (null, '$nomecliente' ,'$pedido', '$descricao', '$preco', '$mesa', '1','' ,'$usuario', '$datahora', '$qtde', '$usuario', '$datahora')";
      $_salvar = mysqli_query($conexao, $inserir);

  $update = "UPDATE `catalogo` SET `qtde_estoque` = '$atualestoque' WHERE `descricao` = '$descricao'";
  $_salvar_novo_estoque = mysqli_query($conexao, $update);


}



if ($_salvar == 1) {

?>
  <form action="pedido.php" method="POST">

    <div class="modal fade" id="modal-primary">
      <div class="modal-dialog">
        <div class="modal-content bg-primary">
          <div class="modal-header">
            <h4 class="modal-title">Salvo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Pedido inserido com sucesso&hellip;</p>
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
<?php
  echo '<meta http-equiv="refresh" content="2;URL=pedido.php"/>';
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
            <p> Não foi possível salvar&hellip;</p>
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