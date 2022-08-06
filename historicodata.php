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
$data = date("d/m/Y");
$datahoje = date("Y-m-d");

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Histórico</title>
</head>

<!-- <div class="text-center"> -->
<form action="" method="POST">
    <div class="card-body">
        <div class="card-deck">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Histórico</h3>
                                    <div class="card-tools">
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="/pages/widgets.html" data-source-selector="#card-refresh-content"><i class="fas fa-sync-alt"></i></button> -->
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">

                                    <div class="flex-center flex-column">
                                        <div class="container">
                                            <div class=" row justify-content-md-center">

                                                <div class="col-sm-2">
                                                    <div class="md-form md-outline input-with-post-icon datepicker">
                                                        <label for="inicio">Selecionar data Inicio</label>
                                                        <input name="dateinicio" type="date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="md-form md-outline input-with-post-icon datepicker">
                                                        <label for="final">Selecionar data Final</label>
                                                        <input name="datefinal" type="date" class="form-control">
                                                    </div>
                                                </div>
                                                <br><br><br><br>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-default btn-lg">Buscar</button>
                                                </div>
                                            </div>


                                            <?php
                                            if (empty($_POST['dateinicio'])) {
                                                $vazio = "";
                                                // echo '<td><a button class="btn btn-success" href="export.php?dateini=' . "" . '">Clique aqui para fazer o download <p> Referente à Data: ' . $data . '</p> </a></td>';
                                                echo "<br>";
                                            ?>
                                                <div class="card-body table-responsive p-0 text-center ">

                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <?php
                                                        $recebidos2 = ("SELECT SUM(valor_pedido * total_pedido) as 'Total Pedido' FROM `pedidos_realizados` where `created_date` BETWEEN '$datahoje 00:00:00' AND '$datahoje 23:59:59' and `total_pedido` <> '0' ");

                                                        $recebidos3 = mysqli_query($conexao, $recebidos2);

                                                        while ($row = mysqli_fetch_assoc($recebidos3)) {
                                                        ?> <h4> <?php echo "Valor Total: R$ " . $row['Total Pedido']; ?> </h4> <?php

                                                                                                                                    echo "<br>";
                                                                                                                                    echo "<br>";
                                                                                                                                }
                                                                                                                                    ?>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Cliente</th>
                                                                <th class="text-center" scope="col">Pedido</th>
                                                                <th scope="col">Valor Total</th>
                                                                <th scope="col">Forma de Pagamento</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $recebidos2 = ("SELECT *, SUM(valor_pedido * total_pedido) as 'Total Pedido' FROM `pedidos_realizados` where `created_date` BETWEEN '$datahoje 00:00:00' AND '$datahoje 23:59:59' and `total_pedido` <> '0' GROUP BY `id_pedido`  ");
                                                            $recebidos3 = mysqli_query($conexao, $recebidos2);
                                                            $index = "1";
                                                            while ($row = mysqli_fetch_assoc($recebidos3)) {


                                                            ?>
                                                                <tr>
                                                                    <th scope="row">
                                                                        <?php echo $index ?>
                                                                    </th>
                                                                    <td>
                                                                        <?php echo $row['cliente'] ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <a href="pedido_detalhes.php?pedido=<?php echo $row['id_pedido'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mostrar"><i class="fa fa-eye"></i></a>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo "R$ ". $row['Total Pedido'] ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $row['forma_pagamento'] ?>
                                                                    </td>

                                                                    <?php
                                                                    $index++;
                                                                    ?>

                                                                </tr>

                                                            <?php }; ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br>
                                        </div>
                                    </div>
                                <?php
                                            } else {

                                                $Datainicio = date('Y-m-d', strtotime($_POST['dateinicio']));
                                                $Datafinal = date('Y-m-d', strtotime($_POST['datefinal']));

                                                // echo '<td><a button class="btn btn-success" href="export.php?dateini=' . $Datainicio . ' 00:00:00' . '&datefinal=' . $Datafinal . ' 23:59:59' . '">Clique aqui para fazer o download  <p> Referente à Data: ' . date('d/m/Y', strtotime($Datainicio)) . " | " . date('d/m/Y', strtotime($Datafinal)) . '  </p>  </a></td>';
                                                echo "<br>";
                                ?>

                                    <div class="card-body table-responsive p-0 text-center ">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <?php
                                                $recebidos2 = ("SELECT SUM(valor_pedido * total_pedido) as 'Total Pedido' FROM `pedidos_realizados` where `created_date` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' and `total_pedido` <> '0' ");

                                                $recebidos3 = mysqli_query($conexao, $recebidos2);

                                                while ($row = mysqli_fetch_assoc($recebidos3)) {
                                            ?> <h4> <?php echo "Valor Total: R$ " . $row['Total Pedido']; ?> </h4> <?php
                                                                                                                    echo "<br>";
                                                                                                                    echo "<br>";
                                                                                                                }
                                                                                                                    ?>
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Cliente</th>
                                                    <th class="text-center" scope="col">Pedido</th>
                                                    <th scope="col">Valor Total</th>
                                                    <th scope="col">Forma de Pagamento</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                $recebidos2 = ("SELECT *, SUM(valor_pedido * total_pedido) as 'Total Pedido' FROM `pedidos_realizados` where `created_date` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' and `total_pedido` <> '0' GROUP BY `id_pedido`  ");

                                                $recebidos3 = mysqli_query($conexao, $recebidos2);
                                                $index = 1;
                                                while ($row = mysqli_fetch_assoc($recebidos3)) {


                                                ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <?php echo $index ?>
                                                        </th>
                                                        <td>
                                                            <?php echo $row['cliente'] ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="pedido_detalhes.php?pedido=<?php echo $row['id_pedido'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mostrar"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <?php echo "R$ ". $row['Total Pedido'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['forma_pagamento'] ?>
                                                        </td>

                                                        <?php
                                                        $index++;
                                                        ?>

                                                    </tr>
                                                <?php }; ?>

                                            </tbody>
                                        </table>
                                    </div>



                                    <br>
                                </div>
                            </div>
                        <?php

                                            }
                        ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</form>