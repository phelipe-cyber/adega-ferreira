<?php
// session_start();
error_reporting(E_ALL);
include('Header_CSS_JS.php');
// include('header_novo.php');

?>
<!DOCTYPE html>
<html>
<div style="padding-left:20px">
    <!-- <h1>Alterar Senha</h1> -->
    <?php
    if (empty($_GET['utilizador']) || empty($_GET['confirmacao']))
        die('<p>Não é possível alterar a senha: dados em falta</p>');
    include('conexao.php');
    $user = $_GET['utilizador'];
    $hash = $_GET['confirmacao'];
    $login = $_GET['login'];
    $result_usuarios = ("SELECT * FROM recuperacao WHERE utilizador = '$user' and confirmacao = '$hash'  ORDER BY utilizador ");
    $resultado_usuarios = mysqli_query($conexao, $result_usuarios);
    if (mysqli_fetch_array($resultado_usuarios) == NULL) {
        # code...
        echo "<script> alert ('Link não localizado no banco de dados')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php" />';
        exit();
    } else {
        $resultado_usuarios = mysqli_query($conexao, $result_usuarios);
        while ($row_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
            if ($user and $hash == $row_usuario['confirmacao'] and $row_usuario['utilizador']) {
                $apagar = ("DELETE FROM `recuperacao` WHERE utilizador = '$user' AND confirmacao = '$hash'");
    ?>
                <br><br>

                <form action="" method="POST">
                    <!-- Modal -->
                    <div class="modal fade" id="elegantModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <i class="fas fa-lock prefix grey-text"></i>
                                            <input required="" name="senhanova" type="password" id="orangeForm-pass" class="form-control validate">
                                            <label data-error="wrong" data-success="right" for="orangeForm-pass">Nova senha</label>
                                        </div>
                                        <div class="md-form mb-5">
                                            <i class="fas fa-lock prefix grey-text"></i>
                                            <input required="" name="confirma" type="password" id="orangeForm-pass" class="form-control validate">
                                            <label data-error="wrong" data-success="right" for="orangeForm-pass">Confirmar a senha</label>
                                        </div>
                                        <div class="text-center mb-3">
                                            <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Alterar</button>
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

                <!-- <div>
    <label for="senhanova">Nova senha:</label>
    <input type="password" name="senhanova" id="senhanova" size="20" />
 </div> 
  <br>
  <div>
      <label for="confirma">Confirma senha:</label>
      <input type="password" name="confirma" id="confirma" size="20" />    
    </div>
    <br>
    <input type="submit" value="Alterar" />
</form> -->
                <?php
                if (empty($_POST['senhanova'])) {
                    $recebe = "";
                    exit();
                } else {

                    if ($_POST['senhanova'] <> $_POST['confirma']) {
                        # code...
                        echo "<script> alert ('Senha diferente!'); </script>";
                        exit();
                    } else {
                        # code...

                        $recebe = $_POST['senhanova'];
                        $confimacao = $_POST['confirma'];

                        $Alt = ("UPDATE `user` SET `senha` = MD5('$recebe'), `password` = '$recebe'  WHERE `user`.`user` = '$login'");
                        $alti = mysqli_query($conexao, $Alt);
                        echo "<script> alert ('Senha alterada com sucesso!'); </script>";
                        echo '<meta http-equiv="refresh" content="0;URL=logout.php" />';
                        // echo  header("Location: logout.php");
                        $deletar = mysqli_query($conexao, $apagar);
                        exit();
                    }
                }
                ?>
    <?php
            } else {
                echo "<script> alert ('Não é possível alterar a senha: Link incorretos!'); </script>";
                exit();
            }
        }
    }

    ?>