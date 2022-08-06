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



<?php
$pedido = $_GET['pedido'];
if ($pedido == "") {
    exit();
} else {

?>

<div class="card-body">          
<div class="card card-primary">
    <div class="card-header">
                <h2 class="card-title">Pedido: <?php echo $pedido ?> </h2>
            </div>
            <!-- /.card-tools -->
            <?php
            $pedido = "SELECT MAX(id_pedido) as 'Pedido' FROM `pedidos_realizados` where `id_pedido` = '$pedido' and `total_pedido` <> '0' ";
$result_pedido = mysqli_query($conexao, $pedido);
while ($row_pedido = mysqli_fetch_assoc($result_pedido)) {
  $pedido = $row_pedido['Pedido'];
}
?>

        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive table table-bordered table-striped">
                <table class="table m-0">

                    <div class="text-center">
                        <br>
                        <!-- <p>Mesa Selecionada : <?php echo $mesa_itens ?></p> -->
                        <?php
                        $soma_total = ("SELECT round(SUM(valor_pedido * total_pedido),2) as `Total Pedido`  FROM `pedidos_realizados` where  `id_pedido` = '$pedido' and `total_pedido` <> '0' ");
                        $recebidos = mysqli_query($conexao, $soma_total);

                        while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                            $total = $row_usuario['Total Pedido'];

                            echo   "SUBTOTAL: R$ " . number_format($total, 2, ',', '.');
                            echo "<br>";
                        };

                        ?>

                    </div>
                <?php
            }
                ?>

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço Un.</th>
                        <th scope="col">Qtde.</th>
                        <th scope="col">Total</th>

                    </tr>
                </thead>
                <tbody>
                    <br>
                    <?php


                    $result_usuarios = ("SELECT *, valor_pedido * SUM(total_pedido) as `Soma itens`, SUM(total_pedido) as `Total itens`  FROM `pedidos_realizados` where  `id_pedido` = '$pedido'  and `total_pedido` <> '0' GROUP by descricao_pedido  ");
                    $recebidos = mysqli_query($conexao, $result_usuarios);
                    $index = 1;
                    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
                        ($row_usuario);
                    ?>
                        <tr>
                            <th scope="row">
                                <?php echo $index ?>
                            </th>
                            <td>
                                <?php echo $row_usuario['descricao_pedido'] ?>
                            </td>
                            <td>
                                <?php echo "R$ ". $row_usuario['valor_pedido'] ?>
                            </td>
                            <td>
                                <?php echo $row_usuario['Total itens'] ?>
                            </td>
                            <td>
                                <?php echo "R$ ". $row_usuario['Soma itens'] ?>
                            </td>

                            <?php
                            $index++;
                            ?>

                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
                </table>

                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
    </div>
            </div>
</div>