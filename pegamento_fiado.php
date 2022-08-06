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


// print_r($_POST);
// exit();

$valortotal = $_POST['preco_total'];

$saldo = $_POST['saldo'];

$valorrecebido = ['valor_recebido'];

$pedido = $_POST['pedido'];

$valortotalsemponto = str_replace("-", "", "$saldo");

?>

<html lang="pt-br">
<!-- <div class="text-center">
    <br>
    <a class="logo"><img src="/images-on-off/adega_logo.png" height="250" width="300">
</div> -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="55mCEseQqQxO8J2a4wE3Rrg3ghJl0lwWM34I49Ed">
    <title>Pagamento</title>
</head>

<form action="salvar_pagamento_fiado.php" method="POST">

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title center">Pagamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>



                        <div class="col-12 col-sm-2 col-md-9">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                                <div class="info-box-content">
                                    <h4>
                                        <span class="info-box-text">TOTAL A PAGAR</span>
                                        <span class="info-box-number"><?php echo $saldo ?></span>
                                    </h4>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->


                            <input name="valordavenda" id="valordavenda" type="hidden" class="form-control validate" value="<?php echo "R$ " . $saldo ?>">
                            <input name="mesa" id="" type="hidden" class="form-control validate" value="<?php echo  $mesa ?>">
                            <input name="finalvenda" id="" type="hidden" class="form-control validate" value="<?php echo  $valortotalsemponto ?>">
                            <input name="pedido" id="" type="hidden" class="form-control validate" value="<?php echo  $pedido ?>">

                            <div class="card-body">
                                <div class="form-group">
                                    <h6>
                                        <label for="">VALOR RECEBIDO</label>
                                    </h6>

                                    <input required onblur="calcular()" value="<?php echo $valortotalsemponto ?>" name="valorrecebido" id="valorrecebido" type="text" class="form-control">

                                </div>

                                </head>
                            </div>
                        </div>

                        <div class="flex-center flex-column" style="height: auto;">
                            <fieldset>
                                <legend><b>Condição de pagamento</b></legend>

                                <div class="custom-control custom-switch custom-control-inline">
                                    <input required type="radio" class="custom-control-input" id="radio-11" name="pagamento" value="A vista">
                                    <label class="custom-control-label" for="radio-11">À vista</label>
                                </div>
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input required type="radio" class="custom-control-input" id="radio-12" name="pagamento" value="credito">
                                    <label class="custom-control-label" for="radio-12">Crédito</label>
                                </div>
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input  required type="radio" class="custom-control-input" id="radio-13" name="pagamento" value="debito">
                                    <label  class="custom-control-label" for="radio-13">Débito</label>
                                </div>
                            </fieldset>
                            <!-- FIM DO FORMULÁRIO -->
<br>
                            <label for="">Troco</label>

                            <div class="col-md-9">
                                <div class="info-box mb-3 bg-info">
                                    <div class="info-box-content">
                                        <h1>
                                            <span class="info-box-number">
                                                <div id="troco"></div>
                                            </span>
                                        </h1>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>

                            <h1>
                                <!-- <div id="troco"></div> -->
                            </h1>
                            <input  type="hidden" name="troco3" id="troco2" type="text" class="form-control">
                            <html>

                            <body>

                                <script type="text/javascript">
                                    var texto = document.getElementById("valorrecebido");
                                    var texto2 = document.getElementById("valordavenda");

                                    //evento dispara quando retira o foco do campo texto
                                    texto.onblur = function calcular() {


                                        var test = texto.value;
                                        var test2 = texto2.value;

                                        function getMoney(str) {
                                            return parseInt(str.replace(/[\D]+/g, ''));
                                        }

                                        function formatReal(int) {
                                            var tmp = int + '';
                                            tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
                                            if (tmp.length > 6)
                                                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

                                            return tmp;
                                        }

                                        var int = getMoney(test) - getMoney(test2);

                                        //alert( int );

                                        // console.log( formatReal( int ) );

                                        troco.innerHTML = "<p>" + "R$ " + formatReal(int) + "</p>";

                                        $("#troco2").val(formatReal(int));

                                    }
                                </script>
                            </body>

                            </html>
                        </div>
                        
                        <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit"  class="btn btn-primary">Salvar</button>
            </div>
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
        $('#valorrecebido').trigger('focus');
        $('#modal-default').modal('show');
    }
    $(document).ready(function() {
        $('#example').DataTable({
            "pagingType": "full_numbers",
            "ordering": false, // false to disable sorting (or any other option)

        });
    });
</script>