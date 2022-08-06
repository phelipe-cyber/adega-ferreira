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

$pedido = $_POST['pedido'];

$result_usuarios = ("SELECT * FROM fiado as a 
                                         WHERE a.pedido = '$pedido' and a.status = '1' ORDER BY a.created_date DESC");

$recebidos = mysqli_query($conexao, $result_usuarios);
$index = 0;
while ($row = mysqli_fetch_assoc($recebidos)) {
    
   
?>
    <td> <?php  $nomefiado = $row['nome'] ?> </td>
    <td> <?php  $valordavenda = $row['preco_total'] ?> </td>
    <td> <?php  $valorrecebido  = $row['valor_recebido'] ?> </td>
    <td> <?php  $saldo = $row['saldo'] ?> </td>
    <td> <?php  $email = $row['email'] ?> </td>

    </tr>
<?php } ?>

<?php

require_once('phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$assunto .= utf8_decode("<strong>Olá $nomefiado </strong><br /><br />");
$assunto .= utf8_decode("<strong> Consta em aberto um débito na ADEGA-SC </strong> <br/><br />");
$assunto .= utf8_decode("<strong> Valor do Consumo:</strong> R$ $valordavenda  <br />");
$assunto .= utf8_decode("<strong> Valor do Adiantamento:</strong> R$ $valorrecebido  <br />");
$assunto .= utf8_decode("<strong> Valor Devedor:</strong> R$ $saldo <br /><br />");

$result_usuarios = ("SELECT
   a.nome, a.fone, a.pedido, a.preco_total, a.status, a.created_user, a.created_date,
   b.descricao_pedido,b.valor_pedido
   
   FROM fiado as a LEFT OUTER JOIN pedidos_realizados as b on b.id_pedido = a.pedido
   WHERE a.pedido = '$pedido' and a.status = '1' ORDER BY a.created_date DESC");
$recebidos = mysqli_query($conexao, $result_usuarios);

//crie uma variável para receber o código da tabela
$assunto .= '<div class="card-body table-responsive p-0">';
$assunto .= '<table border = 1 CELLSPACING = 6">'; //abre table
$assunto .= '<thead>'; //abre cabeçalho
$assunto .= '<tr>'; //abre uma linha
$assunto .= '<th>#</th>'; // colunas do cabeçalho
$assunto .= '<th>Item</th>';
$assunto .= '<th>Valor Unitario</th>';
$assunto .= '</tr>'; //fecha linha
$assunto .= '</thead>'; //fecha cabeçalho
$assunto .= '<tbody>'; //abre corpo da assunto
/*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
$index = 1;
while ($row = mysqli_fetch_assoc($recebidos)) {

    $assunto .= '<tr>'; // abre uma linha
    $assunto .= '<td>' . $index . '</td>'; // coluna Alvara
    $assunto .= '<td>' . utf8_decode($row['descricao_pedido']) . '</td>'; // coluna Alvara
    $assunto .= '<td>' . utf8_decode($row['valor_pedido']) . '</td>'; // coluna Alvara
    $assunto .= '</tr>'; // fecha linha
    /*loop deve terminar aqui*/
    $index++;
}
$assunto .= '</tbody>'; //fecha corpo
$assunto .= '</table>'; //fecha assunto
// echo $assunto; // imprime

$mail->IsHTML(true);
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = '587';
$mail->Host = "smtp.hostinger.com.br";
$mail->Username = "contato@adega-sc.sistemaph.com.br";
$mail->Password =   "Ph@20192008Vba";
$mail->Subject  = utf8_decode("Dedito em aberto referente ao pedido: $pedido na ADEGA-SC");
$mail->From = $mail->Username;
$mail->FromName = "Adega-SC";
$mail->AddAddress($email);
$mail->Body = "<html>
       <head>
          <title>Debito</title>
       </head>
       <body>
         <font face=\"Arial\" size=\"4\" color=\"#333333\"><br />
           $assunto
         </font>			
       </body>
       </html>";
$mail->AltBody = $mail->Body;
  $enviado = $mail->Send();

  if ($enviado == 1) {
    ?>
    
    <form action="historicofiado.php" method="POST">
    
    <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">E-mail</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>E-mail enviado com sucesso&hellip;</p>
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
              <p>Não foi possível enviar o e-mail&hellip;</p>
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