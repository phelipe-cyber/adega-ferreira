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


?>

<html lang="pt-br">
<div class="text-center">
    <br>
    <a class="logo"><img src="/images-on-off/adega.png" height="300" width="370">
</div>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="55mCEseQqQxO8J2a4wE3Rrg3ghJl0lwWM34I49Ed">
    <title>Pagamento</title>
</head>

<?php

$result_usuarios = ("SELECT MAX(id_pedido) as 'Pedido'FROM `pedidos_realizados`");
$recebidos = mysqli_query($conexao, $result_usuarios);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

    $pedido = $row_usuario['Pedido'];
}
if ($pedido == null) {
    $pedido = "1000001";
} else {

    $result_usuarios = ("SELECT MAX(id_pedido)+1 as 'Pedido'FROM `pedidos_realizados`");
    $recebidos = mysqli_query($conexao, $result_usuarios);

    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

        $pedido = $row_usuario['Pedido'];
    }
}


?>

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
                <form action="" method="POST">
                    <div class="col-md-6">
                        <div id="teste">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <input name="nome" id="nome" type="text" class="form-control" placeholder="Nome Cliente">
                            </div>
                            <div class="form-group">
                                <label>Serviço Realizado</label>

                                <select class="select2" name="id_descricao_preco[]" multiple="multiple" data-placeholder="Selecionar ou Digitar" style="width: 100%;">
                                    <?php
                                    $result_usuarios = ("SELECT * FROM `catalogo` where `status` = '1' ");
                                    $recebidos = mysqli_query($conexao, $result_usuarios);
                                    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
                                    ?>
                                        <option value="<?php echo $row_usuario['id'] ?>"><?php echo $row_usuario['descricao'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="btn-group">
                                <td>
                                    <button type="submit" class="btn btn-block btn-primary">Buscar</button>
                                </td>
                            </div>
                        </div>
                    </div>

                </form>
                <?php

                if ($_POST['id_descricao_preco'] == "") {
                } else {
                    // echo "<br>";
                    // print_r($_POST);
                    // echo "<br>";
                    $id_descricao_preco = $_POST['id_descricao_preco'];


                    ($id_descricao_preco);

                    $Arraydescricao = array();
                    foreach ($id_descricao_preco as $id) {
                        $id . " | ";
                        $id = explode(" | ", $id);

                        $in =  implode("','", array_filter($id));

                        $result_usuarios = ("SELECT * FROM `tesoura_catalogo_preco` where `id` = '$in' ");
                        $recebidos = mysqli_query($conexao, $result_usuarios);

                        $valor = 0;
                        while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                            $preco_corte = $row_usuario['preco'];
                            $descricao = $row_usuario['descricao'];

                            $Arraydescricao[] = $descricao;
                        }


                        $valor2 = $valor + $preco_corte;

                        if (!isset($value_total)) $value_total = [];
                        $value_total = array_merge($value_total, [$valor2]);
                        $precototal = array_sum($value_total);
                    }

                    $Arraydescricao2 = implode(" | ", $Arraydescricao);

                    // print_r($Arraydescricao2);

                    $nome = $_POST['nome'];

                    // echo "<br>";
                    // print_r($precototal);
                    // echo "<br>";
                ?>
                    <script>
                        setTimeout(function() {
                            $('#teste').fadeOut('fast');
                        }, 0);
                    </script>

                    <form action="salvar_pagamento.php" method="POST">
                        <div class="col-12 col-sm-2 col-md-9">
                            <span class="info-box-text">Pedido:</span>
                            <?php echo $pedido; ?>
                            <div>
                                <span class="info-box-text">Nome Cliente:</span>
                                <?php echo $nome; ?>
                            </div>
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <h4>
                                        <span class="info-box-text">TOTAL A PAGAR</span>
                                        <span class="info-box-number"><?php echo "R$ " . $precototal ?></span>
                                        <input value="<?php echo $precototal ?>" name="valordavenda" id="valordavenda" type="hidden" class="form-control">
                                        <input value="<?php echo $nome ?>" name="nome" id="nome" type="hidden" class="form-control">
                                        <input value="<?php echo $pedido ?>" name="pedido" id="pedido" type="hidden" class="form-control">
                                        <input value="<?php echo $Arraydescricao2 ?>" name="descricao" id="descricao" type="hidden" class="form-control">

                                    </h4>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Valor recebido</label>
                                    <input required onblur="calcular()" data-inputmask="'mask' : ''" value="<?php echo $precototal ?>" name="valorrecebido" id="valorrecebido" type="text" class="form-control">

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
                                    <input required type="radio" class="custom-control-input" id="radio-13" name="pagamento" value="debito">
                                    <label class="custom-control-label" for="radio-13">Débito</label>
                                </div>
                                <!-- Botao -->
                                <!-- <input type="radio" value="" id="receita1"> -->
                                <div id="central">
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="receita14" name="pagamento" value="fiado">
                                        <label class="custom-control-label" for="receita14">Fiado</label>
                                    </div>
                                    <!-- conteudo escondido -->
                                    <div id="14" class="escondida">
                                        <!-- Aqui fica o seu form -->
                                        <!-- INICIO DO FORMULÁRIO -->
                                        <br>
                                        <!-- <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            <input name="nomefiado" value="<?php echo $nome ?>" type="text" class="form-control" placeholder="Nome">
                                        </div> -->
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <input name="email" type="email" class="form-control" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input name="fonefiado" type="text" class="form-control" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Nome<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="nomefiado" placeholder="" />
                                            </div>
                                        </div> -->
                                        <!-- <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">Telefone<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="tel" data-inputmask="'mask' : '(99) 99999-9999'" class='tel' name="fonefiado" data-validate-length-range="8,20" /></div>
                                        </div> -->
                                        <!-- <div class="field item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3  label-align">E-mail<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control" type="tel" data-inputmask="'mask' : '" class='mail' name="email" data-validate-length-range="8,20" /></div>
                                        </div> -->
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
                            <br>
                            <!-- <div class="text-center"> -->
                            <legend><b>TROCO</b></legend>
                            <!-- <label for="">Troco</label> -->
                            <!-- </div> -->
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

                            <input type="hidden" name="troco3" id="troco2" type="text" class="form-control">
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


                                        console.log(formatReal(int));

                                        troco.innerHTML = "<p>" + "R$ " + (int) + "</p>";

                                        $("#troco2").val((int));

                                    }
                                </script>


                            </body>

                            </html>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
            </div>
        <?php
                }
        ?>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </form>
    <script>
        var senha = 0;

        if (senha != 1) {

            $("#nome").on("input", function() {

                $(this).val($(this).val().toUpperCase());
            });

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