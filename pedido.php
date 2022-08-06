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
    <!-- <a class="logo"><img src="/images-on-off/adega_logo.png" height="250" width="300"> -->
</div>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="55mCEseQqQxO8J2a4wE3Rrg3ghJl0lwWM34I49Ed">
    <title>Pedido</title>
</head>

<form action="salvar_pedido.php" method="POST">
    <div class="card-body">
        <div class="card-deck">
            <div class="card mb-4">
                <div class="modal fade" id="modal-lg">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Criar Pedido</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                <div class="card-body table-responsive p-0">


                                    <table id="example1" class="table table-bordered table-striped ">

                                        <!-- <table id="example1" class="table table-bordered table-striped"> -->
                                        <thead>
                                            <tr>
                                                <th scope="col">Descrição</th>
                                                <!-- <th scope="col">Preço</th> -->
                                                <!-- <th scope="col">Qtde. Estoque</th> -->
                                                <th class="text-center" scope="col-5">Qtde. Inserir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            $result_usuarios = ("SELECT MAX(id_pedido) as 'Pedido'FROM `pedidos_realizados`");
                                            $recebidos = mysqli_query($conexao, $result_usuarios);

                                            while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                                                $pedido = $row_usuario['Pedido'];
                                            }
                                            if ($pedido == null) {
                                                $pedido = "1000001";
                                            } else {


                                                $result_usuarios = ("SELECT MAX(id_pedido)+1 as 'Pedido'FROM `pedidos_realizados` ");
                                                $recebidos = mysqli_query($conexao, $result_usuarios);

                                                while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                                                    $pedido = $row_usuario['Pedido'];
                                                }
                                            };
                                            $pedido = $pedido;


                                            ?>
                                            <h6> Pedido: <?php echo $pedido ?> </h6>
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </div>
                                                </div>
                                                <input name="nome_cliente" id="nome_cliente" type="text" class="form-control" placeholder="Nome Cliente" autofocus="autofocus">
                                                <input name="pedido_novo" type="hidden" value="<?php echo $pedido ?>" class="form-control">

                                            </div>
                                            <?php
                                            $result_usuarios = ("SELECT * FROM `catalogo` where `status` = 1 and `qtde_estoque` > 0 ");
                                            $recebidos = mysqli_query($conexao, $result_usuarios);
                                            $index = 0;
                                            while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <h5>
                                                            <?php echo $row_usuario['descricao'] ?>
                                                            <input name="pecadetalhe[<?= $index ?>][descricao]" class="input is-large" value="<?php echo $row_usuario['descricao'] ?>" type="hidden">
                                                        </h5>
                                                        <p>
                                                            <?php echo "R$ " . $row_usuario['preco'] ?>
                                                            <input name="pecadetalhe[<?= $index ?>][preco]" class="input is-large" value="<?php echo $row_usuario['preco'] ?>" type="hidden">
                                                        </p>
                                                        <p>
                                                            <?php echo "Qtde Estoque: " . $row_usuario['qtde_estoque'] ?>
                                                            <input name="pecadetalhe[<?= $index ?>][qtde_estoque]" class="input is-large" value="<?php echo $row_usuario['qtde_estoque'] ?>" type="hidden">
                                                        </p>
                                                    </td>


                                                    <td class="text-center">
                                                        <div style="width: 100px;display: inline-block;" class="btn-group">

                                                            <input class="btn btn-block bg-gradient-success btn-xs" value="+" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></input>
                                                            <input class="btn btn-block bg-gradient-default btn-xs" name="pecadetalhe[<?= $index ?>][qtde]" min="0" max="<?php echo $row_usuario['qtde_estoque'] ?>" name="quantity" value="0" type="number">
                                                            <input class="btn btn-block bg-gradient-danger btn-xs" value="-" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></input>

                                                                    

                                                                <!-- <button class="less">-</button>
                                                                    <input type="number" id="level" name="quantity" min="1" max="5">
                                                                <button class="more">+</button> -->


                                                        </div>
                                                    </td>
                                                <?php
                                                $index++;
                                            } ?>

                                    </table>
                                    </p>
                                </div>

                                <div class="fixo">
                                    <!-- <p> -->
                                        <!-- Total : -->
                                    <!-- </p> -->
                                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button> -->
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>

                            </div>
                            <div class="container">
                                <div class="fixo"></div>
                            </div>
                            <style>
                                .fixo {
                                    width: 774px;
                                    height: 40px;
                                    /* background: #E0FFFF; */
                                    position: fixed;
                                    top: 85%;
                                    /* background-color: white; */
                                    /* color: gold; */
                                    /* left: 50%; */
                                }
                            </style>



                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
</form>

<script>
    var senha = 0;

    if (senha != 1) {
        $('#modal-lg').modal('show');
    }
    $(document).ready(function() {
        $('#example').DataTable({
            // "pagingType": "full_numbers",
            "ordering": false, // false to disable sorting (or any other option)

        });
    });
</script>
<script>
    $("#nome_cliente").on("input", function() {
        $(this).val($(this).val().toUpperCase());
        $('#nome_cliente').trigger('focus');
    });
</script>
<?php
// exit();
?>
<div class="card-body">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pedidos</h3>
                    <div class="card-tools">
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/pages/widgets.html" data-source-selector="#card-refresh-content"><i class="fas fa-sync-alt"></i></button> -->
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->

                <div class="card-body table-responsive p-0">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr style="text-align:center">
                                <th>Cliente</th>
                                <th>Ver Pedidos</th>
                                <th>Incluir Pedidos</th>
                                <th>Excluir Item</th>
                                <th>Excluir Pedido</th>
                                <th>Pagar</th>
                                <th>Status da Pedido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php



                            $result_usuarios = ("SELECT * FROM `pedidos_realizados` where `status_pedido` = '1' and `total_pedido` <> '0' group by `id_pedido` ");
                            $recebidos = mysqli_query($conexao, $result_usuarios);
                            $index = 0;
                            while ($row = mysqli_fetch_assoc($recebidos)) {
                                $pedido_exluir = $row['id_pedido'];
                            ?>

                                <tr style="text-align:center">
                                    <td> <?php echo $row['cliente'] ?> </td>

                                    <td>
                                        <a href="pedido_detalhes.php?pedido=<?php echo $row['id_pedido'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mostrar"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <a href="pedido_editar.php?editar_pedido=<?php echo $row['id_pedido'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form action="excluir_item.php" method="POST">
                                            <input type="text" class="custom-control-input" name="pedido" value="<?php echo $row['id_pedido'] ?>">
                                            <button type="submit" class="btn btn-danger float-center"><i class="far fa-trash-alt"></i>Excluir item</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="excluir_pedido.php" method="POST">
                                            <input type="text" class="custom-control-input" name="pedido_excluir" value="<?php echo $pedido_exluir ?>">
                                            <button type="submit" class="btn btn-danger float-center"><i class="far fa-trash-alt"></i>Excluir Pedido</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="pagamento.php" method="POST">
                                            <input type="text" class="custom-control-input" name="pedido" value="<?php echo $row['id_pedido'] ?>">
                                            <button type="submit" class="btn btn-success float-center"><i class="far fa-credit-card"></i> Pagamento</button>
                                        </form>
                                    </td>

                                    <td>
                                        <?php if ($row['staus_pedido'] <= 0) {
                                        ?> <a class="logo"><img src="/images-on-off/off.png" height="40" width="40" /> </a> <?php
                                                                                                                        } else {
                                                                                                                            ?> <a class="logo"><img src="/images-on-off/on.png" height="40" width="40" /> </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
</div>

</div>
</div>
</div>