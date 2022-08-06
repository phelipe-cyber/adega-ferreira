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

$mesa = $_POST['mesa'];

$pedido = $_POST['pedido'];


$soma_total = ("SELECT round(SUM(valor_pedido * total_pedido),2) as `Total Pedido`  FROM `pedidos_realizados` where `status_pedido` = '1' and `id_pedido` = '$pedido'");
                        $recebidos = mysqli_query($conexao, $soma_total);

                        while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                            $valortotal = $row_usuario['Total Pedido'];

                        };


 $valortotalsemponto = str_replace(",", ".", "$valortotal");

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

<form action="salvar_pagamento.php" method="POST">

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
                                        <span class="info-box-number"><?php echo "R$ " . $valortotal ?></span>
                                    </h4>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->


                            <input name="valordavenda" id="valordavenda" type="hidden" class="form-control validate" value="<?php echo "R$ " . $valortotal ?>">
                            <input name="mesa" id="" type="hidden" class="form-control validate" value="<?php echo  $mesa ?>">
                            <input name="finalvenda" id="" type="hidden" class="form-control validate" value="<?php echo  $valortotalsemponto ?>">
                            <input name="pedido" id="" type="hidden" class="form-control validate" value="<?php echo  $pedido ?>">

                            <div class="card-body">
                                <div class="form-group">
                                    <h6>
                                        <label for="">VALOR RECEBIDO</label>
                                    </h6>

                                    <input required onblur="calcular()" data-inputmask="'mask' : ''" value="<?php echo $valortotal ?>" name="valorrecebido" id="valorrecebido" type="text" class="form-control">

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
                                    <input required type="radio" class="custom-control-input" id="radio-12" name="pagamento" value="Crédito">
                                    <label class="custom-control-label" for="radio-12">Crédito</label>
                                </div>
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input  required type="radio" class="custom-control-input" id="radio-13" name="pagamento" value="Débito">
                                    <label  class="custom-control-label" for="radio-13">Débito</label>
                                </div>
                                <!-- Botao -->
                                <!-- <input type="radio" value="" id="receita1"> -->
                                <div id="central">
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="receita14" name="pagamento" value="Fiado">
                                        <label class="custom-control-label" for="receita14">Fiado</label>
                                    </div>
                                    <!-- conteudo escondido -->
                                    <div id="14" class="escondida">
                                        <!-- Aqui fica o seu form -->
                                        <!-- INICIO DO FORMULÁRIO -->
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Nome<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="nomefiado" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Telefone<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="tel" data-inputmask="'mask' : '(99) 99999-9999'" class='tel' name="fonefiado" data-validate-length-range="8,20" /></div>
                                        </div>
                                        <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">E-mail<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="email" class='email' name="email" data-validate-length-range="8,20" /></div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                           
                            </script>
                            <!-- FIM DO FORMULÁRIO -->
                            <script>
                                    function mostrar() {
                                        document.getElementById('escondida').style.visibility = 'hidden';
                                            }

                                function ocultar() {
                                    document.getElementById('escondida').style.visibility = 'visible';
                                }
                            </script>
                            <style type="text/css">
                                .escondida {
                                    display: none;
                                }
                            </style>

                            <script type="text/javascript">
                                function abrir() {
                                    var main = document.getElementById("central");
                                    var iten = main.getElementsByTagName("input");
                                    if (iten) {
                                        for (var i = 0; i < iten.length; i++) {
                                            iten[i].onclick = function() {
                                                var el = document.getElementById(this.id.substr(7, 7));
                                                if (el.style.display == "block")
                                                    el.style.display = "none";
                                                else
                                                    el.style.display = "block";
                                            }
                                        }
                                    }
                                }
                                window.onload = abrir;
                            </script>

                            <label for="">Troco</label>

                            <div class="col-md-9">
                                <div class="info-box mb-3 bg-info">
                                    <div class="info-box-content">
                                        <h1>
                                            <span class="info-box-number">
                                                 <div id="troco">
                                                     </div>
                                                    </span>
                                                </h1>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </div>
                                    
                                    <input  type="hidden" name="troco3" id="troco2" type="text" class="form-control">
                            <h1>
                                <!-- <div id="troco"></div> -->
                            </h1>
                            <!-- <input  name="troco" id="troco" type="text" class="form-control validate"> -->
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

                                        // alert( int ); 
                                        
                                        
                                        console.log( formatReal( int ) );
                                        
                                        troco.innerHTML = "<p>" + "R$ " + formatReal(int) +  "</p>";
                                        
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
                <?php
                
                ?>
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