<?php
error_reporting(E_ALL);
session_start();
include('Header_CSS_JS.php');
?>

<html lang="pt-br">
    
    <div class="text-center">
        <br>
        <a class="logo"><img src="/images-on-off/adega_logo_ferreira.png" height="300" width="370">
    </div>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="55mCEseQqQxO8J2a4wE3Rrg3ghJl0lwWM34I49Ed">
        <link rel="shortcut icon"  href="/images-on-off/icone.ico"><!--este comando muda o icone da janela-->
    <title>LOGIN ADEGA FERREIRA</title>
</head>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center">
                    <br>
                    <a class="logo"><img src="/images-on-off/adega_logo_ferreira.png" height="200" width="280">
                </div>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <form action="login.php" method="POST">



                    <?php

                    if (isset($_SESSION['nao_autenticado_user'])) :
                    ?>
                        <div class="alert alert-danger text-center " role="alert">
                            ERRO: Usuário Desativado.
                        </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado_user']);


                    if (isset($_SESSION['nao_autenticado'])) :
                    ?>
                        <div class="alert alert-danger text-center " role="alert">
                            ERRO: Usuário ou senha inválidos.
                        </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>


                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input name="usuario" id="login" type="text" class="form-control" placeholder="Login">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input name="senha" type="password" class="form-control" placeholder="Senha">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="md-form pb-3">
                        <p class="font-small blue-text d-flex justify-content-end">Esqueceu<a href="perdipassword.php" class="blue-text ml-1">
                                a senha?</a></p>
                    </div>
                </form>
                </body>

</html>

</div>
</div>
<?php
?>

<script>
    var senha = 0;

    if (senha != 1) {


        $('#modal-default').modal('show', function() {
            $('#nome').focus()
        })

        // $('#modal-default').modal('show', function() {
        // $('#nome').Delay(0).focus().Select();
        // $('#nome').trigger('focus')
        // })
        // $('#modal-default').modal('show');

        // $('#valorrecebido').trigger('focus');


    }
    $(document).ready(function() {
        $('#example').DataTable({
            "pagingType": "full_numbers",
            "ordering": false, // false to disable sorting (or any other option)

        });
    });
</script>