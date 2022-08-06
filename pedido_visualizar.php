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
                    <div class="table-responsive table table-bordered table-striped">
                        <table class="table m-0">

                            <thead>
                                <tr style="text-align:center">
                                    <th>Cliente</th>
                                    <th>Ver Pedidos</th>
                                    <th>Incluir Pedidos</th>
                                    <th>Excluir Item</th>
                                    <th>Pagar</th>
                                    <th>Status da Mesa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php



                                $result_usuarios = ("SELECT * FROM `pedidos_realizados` where `status_pedido` = '1' and `total_pedido` <> '0' group by `id_pedido` ");
                                $recebidos = mysqli_query($conexao, $result_usuarios);
                                $index = 0;
                                while ($row = mysqli_fetch_assoc($recebidos)) {

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
                                                <button type="submit" class="btn btn-danger float-center"><i class="far fa-trash-alt"></i> Excluir</button>
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
