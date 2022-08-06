<?php
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
$usuario = $_SESSION['usuario'];
$qtd = 0;
$id_status = 2;



echo $login = $_POST['login'];

if($login == ""){
exit();
}else{

                $email = $rest['email'];
                $email = strtolower($email);
                $login = $_POST['login'];
                $login = strtolower($login);
                $senha = ($_POST['senha']);
                $senha = MD5($senha);
                $senha_mostrar = ($_POST['senha']);

                $emailcriar = $_POST['email'];

                $inserir = " INSERT INTO `user`(`id`, `user`, `senha`, `password`, `e-mail`, `status`, `created_user`, `created_date`, `updated_at_user`, `updated_at`) VALUES
                 (null, '$login', '$senha', '$senha_mostrar','$emailcriar', '1','$usuario','$datahora','$usuario','$datahora')";
                
                 $_salvar = mysqli_query($conexao, $inserir);
                
                 //echo "<br>";
                //echo $_salvar; 
               //  echo "<br>";

                if ($_salvar == 1) {
                  ?>
                  
                      <form action="usuarios.php" method="POST">
                  
                      <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">Salvo</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <p>Login criado com sucesso &hellip;</p>
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
        echo '<meta http-equiv="refresh" content="3;URL=usuarios.php?"/>';
?>
<?php
                  require_once('phpmailer/class.phpmailer.php');
                  $mail = new PHPMailer();
                  $assunto .= utf8_decode("<strong>Olá</strong> $usuario <br /><br />");
                  $assunto .= "<strong> Login criado para:</strong> $login <br />";
                  $assunto .= utf8_decode("<strong> Senha:</strong> adega123 <br />");
                 
                  $mail->IsHTML(true);
                  $mail->IsSMTP();
                  $mail->SMTPAuth = true;
                  $mail->Port = '587';
                  $mail->Host = "smtp.hostinger.com.br";
                  $mail->Username = "";
                  $mail->Password =   "";
                  $mail->Subject  = utf8_decode("Criado login para: $login");
                  $mail->From = $mail->Username;
                  $mail->FromName = "";
                  $mail->AddAddress($email);
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
                    echo "<script> alert ('E-mail enviado para ( $email ) com a senha e login ')</script>";
                } else {
                    # code...
                    echo "<script> alert ('Erro ao enviar o E-mail')</script>";
                    // echo '<meta http-equiv="refresh" content="1;URL=index.php" />';
                    // echo " (' Erro ao enviar o E-mail )";

                }
?>
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
                      
                  <?php
                      exit();

                  } else {
                  ?>
                  
                      <form action="usuarios.php" method="POST">
                  
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
                
                
}
?>

</body>
</div>
</body>
</div>

</html>