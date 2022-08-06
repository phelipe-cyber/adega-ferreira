<?php
error_reporting(E_ERROR | E_PARSE);
// include('header_novo.php');
include('Header_CSS_JS.php');
include('conexao.php');
date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');
$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));
$usuario = $_SESSION['usuario'];

?>
<!DOCTYPE html>
<html>
<div style="padding-left:20px">
<!-- <h1>Recuperar senha</h1> -->
<?php


if( !empty($_POST) ){

if (empty($_POST['email'])){
$recebe = "";
} else {
$user =  $_POST['email'];
$login = $_POST['login'];

$q = ("SELECT * FROM user WHERE `e-mail` = '$user' and `user` = '$login' ");
$re = mysqli_query($conexao, $q);
$rest = mysqli_fetch_array($re);

if ( $rest['e-mail'] == NULL) {
    # code...
        echo "<script> alert ('E-mail ( $user )  não localizado no banco de dados')</script>";
        // echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
        exit();
    } else {
       
$re = mysqli_query($conexao, $q);
while($r = mysqli_fetch_assoc($re)){
if($_POST['email'] == $r['e-mail'] ){
$chave = sha1(uniqid( mt_rand(), true));
$login = $_POST['login'];
$conf = ("INSERT  INTO recuperacao (`utilizador`, `confirmacao`,`login`,`data_hora`) VALUES ('$user', '$chave','$login','$datahora')");
$con = mysqli_query($conexao, $conf);
$link = "http://adega-sc.sistemaph.com.br/recuperar.php?utilizador=$user&confirmacao=$chave&login=$login";

require_once('phpmailer/class.phpmailer.php');
$mail = new PHPMailer();
$assunto .= utf8_decode("<strong>Olá $user </strong><br />");
$assunto .= utf8_decode("<strong>Click no link abaixo para alterar a senha do usuário $login </strong><br />");
$assunto .= utf8_decode("<strong> Link:</strong> $link <br />");

$mail->IsHTML(true);
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = '587';
$mail->Host = "smtp.hostinger.com.br"; 
$mail->Username = "contato@adega-sc.sistemaph.com.br";
$mail->Password =   "Ph@20192008Vba";
$mail->Subject  = utf8_decode("Alterar senha do usuario: $login");
$mail->From = $mail->Username;
$mail->FromName = "Adega-sc";
$mail->AddAddress($user);
		$mail->Body = "<html>
		<head>
		   <title>Alteração de senha</title>
		</head>
		<body>
			<font face=\"Arial\" size=\"4\" color=\"#333333\"><br />
				$assunto
			</font>			
		</body>
		</html>";
		$mail->AltBody = $mail->Body;
	$enviado = $mail->Send();
  
        if ($enviado) {
            # code...
            echo "<script> alert ('E-mail enviado com sucesso')</script>";
            echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
            // echo " ( Email enviado ) ";

        exit();
        } else {
            # code...
            echo "<script> alert ('Erro ao enviar o E-mail')</script>";
            // echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
            // echo " (' Erro ao enviar o E-mail )";
            exit();
        }

// if(mail($user, 'Recuperação de password', 'Olá '.$user.', visite este link '.$link) ){
// echo '<p>Foi enviado um e-mail para o seu endereço, onde poderá encontrar um link único para alterar a sua password</p>';
// } else {
// echo "<script> alert ('Houve um erro ao enviar o email (o servidor suporta a função mail?'); </script>";
// }
// echo '<p>Link: '.$link.' </p>';
} else {
echo "<script> alert ('Esse Usuario não existe'); </script>";
}
}
}
}
} else {
// mostrar formulário de recuperação
?>


<form action="" method="POST">
<!-- Modal -->
<div class="modal fade" id="elegantModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!--Content-->
    <div class="modal-content form-elegant">
      <!--Header-->
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Recuperar Senha</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body mx-4">
        <!--Body-->
        

        <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input name="login" value="" type="text" id="form34" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form34">Login de acesso</label>
        </div>

        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input name="email" value="" type="email" id="form29" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form29">E-mail de Recuperação</label>
        </div>

        <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit"  class="btn btn-primary">Recuperar</button>
            </div>
        
        <div class="row my-3 d-flex justify-content-center">
         
        </div>
      </div>
      <!--Footer-->
      <div class="modal-footer mx-5 pt-3 mb-1">
        
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
</form>

<script>
        var senha = 0;

        if (senha != 1) {
            $('#elegantModalForm').modal('show');
        }
    </script>


<!-- <form method="post">
 <div>
    <label for="email">E-mail do Supervisor:</label>
    <input type="text" name="email" id="email" />
 </div>
 <br>
 <div>
    <label for="login">Login de Recuperação:</label>
    <input type="text" name="login" id="login" value="" />
 </div>
 <br>
<input type="submit" value="Recuperar" />
</form> -->
<?php
}

?>