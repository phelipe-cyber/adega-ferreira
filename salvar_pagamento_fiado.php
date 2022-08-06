<?php
error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
include('header_novo.php');
include('conexao.php');
include('Header_CSS_JS.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario = $_SESSION['usuario'];


$pedido = $_POST['pedido'];
$pagamento = $_POST['pagamento'];

$valorrecebido = $_POST['valorrecebido'];


$troco = $_POST['troco3'];
$trocosemponto = str_replace(",", ".", "$troco");


  $output  = str_replace(",", ".", $valordavenda);

  $insert_fiado ="UPDATE `fiado` SET  `updated_at_user` = '$usuario',  `updated_at` = '$datahora',  `valor_recebido` = '$valorrecebido',  `status` = '2', `forma_pagamento` = '$pagamento', `saldo` = '$trocosemponto'   WHERE `fiado`.`id` = 1;
  
--    VALUES (null,'$nomefiado','$fonefiado', '$pedido','$output','1','$usuario','$datahora')";
   $salve_fiado = mysqli_query($conexao, $insert_fiado);


   ?>
   <input  name="valorrecebido" id="valorrecebido" type="hidden" class="form-control validate" value="<?php echo  $valorrecebido ?>">
   <input  name="valordavenda" id="valordavenda" type="hidden" class="form-control validate" value="<?php echo  $valordavenda ?>">
   <input  name="mesa" id="mesa" type="hidden" class="form-control validate" value="<?php echo  $mesa ?>">
   <?php

 
  $update ="UPDATE `pedidos_realizados` SET `status_pedido` = '2' WHERE `pedidos_realizados`.`id_pedido` = '$pedido'";
 
 $salve = mysqli_query($conexao, $update);
 
  $udatemesa = "UPDATE `mesa` SET `status` = '1' WHERE `mesa`.`mesa` = '$mesa'";
 
 $salve_mesa = mysqli_query($conexao, $udatemesa);


   if ($salve_fiado == 1) {
    ?>
    
    <form action="historicofiado.php" method="POST">
    
    <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">Salvo FIADO </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>FIADO salvo&hellip;</p>
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
        echo '<meta http-equiv="refresh" content="3;URL=historicofiado.php?"/>';
        exit();
    } else {
    ?>
    
        <form action="historicofiado" method="POST">
    
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

<div id="troco">
    <input  name="troco" id="troco" type="hidden" class="form-control validate">
</div>

<script type="text/javascript">
            var texto = document.getElementById("valorrecebido");
            var texto2 = document.getElementById("valordavenda");

var test = texto.value;
var test2 = texto2.value;

function getMoney( str )
{
        return parseInt( str.replace(/[\D]+/g,'') );
}
function formatReal( int )
{
        var tmp = int+'';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return tmp;
}

var int = getMoney( test );

console.log( formatReal( int ) );
//alert( int );


troco.innerHTML = "<p>"+ "R$ "+ formatReal(int)+"</p>";

        </script>