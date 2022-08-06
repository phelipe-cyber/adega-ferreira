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
<div class="card-body">
    <div class="card-deck">
        <div class="card mb-4">
            <div class="card-body">
                <div class="container">
                    <div class="row">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">FIADO</h3>

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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="text-align:center">
                                            <th>Nome</th>
                                            <!-- <th>E-mail</th> -->
                                            <th>Fone</th>
                                            <!-- <th>Pedido</th> -->
                                            <th>Valor Total</th>
                                            <th>Valor Pago</th>
                                            <th>Saldo | Devedor</th>
                                            <th>Ver pedidos</th>
                                            <th>Pagamento</th>
                                            <th>Cobrar</th>
                                            <th> Pedido | Status</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result_usuarios = ("SELECT * FROM fiado as a  ORDER BY a.created_date DESC");

                                        $recebidos = mysqli_query($conexao, $result_usuarios);
                                        $index = 0;
                                        while ($row = mysqli_fetch_assoc($recebidos)) {

                                        ?>

                                            <tr style="text-align:center">
                                                <td> <?php echo $row['nome'] ?> </td>
                                                <!-- <td> <?php echo $row['email'] ?> </td> -->
                                                <td> <?php echo $row['fone'] ?> </td>
                                                <!-- <td> <?php echo $row['pedido'] ?> </td> -->
                                                <td> <?php echo $row['preco_total'] ?> </td>
                                                <td> <?php echo $row['valor_recebido'] ?> </td>
                                                <td> <?php echo $row['saldo'] ?> </td>

                                                <td>
                                                    <a href="historicofiado_pedido.php?pedido=<?php echo $row['pedido'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mostrar"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    <form action="pegamento_fiado.php" method="POST">
                                                        <input type="text" class="custom-control-input" name="pedido" value="<?php echo $row['pedido'] ?>">
                                                        <input type="text" class="custom-control-input" name="valorpago" value="<?php echo $row['valor_recebido'] ?>">
                                                        <input type="text" class="custom-control-input" name="saldo" value="<?php echo $row['saldo'] ?>">
                                                        <input type="text" class="custom-control-input" name="email" value="<?php echo $row['email'] ?>">

                                                        <button type="submit" class="btn btn-success float-center"><i class="far fa-credit-card"></i>Pagamento</button>
                                                    </form>
                                                </td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                ?>
                                                    <td>
                                                        <form action="email_fiado.php" method="POST">
                                                            <input type="text" class="custom-control-input" name="pedido" value="<?php echo $row['pedido'] ?>">
                                                            <input type="text" class="custom-control-input" name="valorpago" value="<?php echo $row['valor_recebido'] ?>">
                                                            <input type="text" class="custom-control-input" name="saldo" value="<?php echo $row['saldo'] ?>">
                                                            <input type="text" class="custom-control-input" name="email" value="<?php echo $row['email'] ?>">
                                                            <input type="text" class="custom-control-input" name="email" value="<?php echo $row['email'] ?>">

                                                            <button type="submit" class="btn btn-info float-center"><i class=""></i>Enviar e-mail</button>

                                                        </form>
                                                    </td>
                                                <?php
                                                } else {
                                                ?><td></td><?php
                                                                                        }
                                                                                            ?>

                                                <td>
                                                            <form action="" method="POST" >
                                                    <?php
                                                     if ($row['status'] == 1) {
                                                    ?>
                                                        <a class="logo"><img src="/images-on-off/off.png" height="40" width="40" />Pendente</a>
                                                        <div id="central">
                                                            <div class="">
                                                                <!-- <input  type="" class="" id="receita<?php echo $index ?>" name="pedido" value="<?php echo $row['pedido'] ?>"> -->
                                                                <label class="" for="receita<?php echo $index ?>"><?php echo "Ped: " . $row['pedido'] ?></label>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <a class="logo"><img src="/images-on-off/on.png" height="40" width="40" />Pago</a>
                                                        <div id="central">
                                                            <label class="" for="receita<?php echo $index ?>"><?php echo "Ped :" . $row['pedido'] ?></label>
                                                        </div>
                                                        <?php } ?>
                                                </td>
                                            </tr>
                                        <?php
                                    $index ++ ;
                                    } ?>

                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>