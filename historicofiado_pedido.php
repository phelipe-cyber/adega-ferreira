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

$pedido = $_GET['pedido'];

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

                                    <?php
                                    $result_usuarios = ("SELECT 
                                        a.nome, a.fone, a.pedido, a.preco_total, a.status, a.saldo, a.created_user, a.created_date,
                                        b.descricao_pedido,b.valor_pedido
                                        
                                        FROM fiado as a LEFT OUTER JOIN pedidos_realizados as b on b.id_pedido = a.pedido
                                        WHERE a.pedido = '$pedido' and a.status = '1' ORDER BY a.created_date DESC limit 1");

                                    $recebidos = mysqli_query($conexao, $result_usuarios);
                                    $index = 1;
                                    while ($row = mysqli_fetch_assoc($recebidos)) {

                                        $nome = $row['nome'];

                                        $email = $row['email'];

                                        $pedido =  $row['pedido'];

                                        $valortotal = $row['preco_total'];

                                        $saldo = $row['saldo'];


                                    ?>
                                        <br>
                                        <div class="col-md-6">
                                            <div class="card card-default">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-bullhorn"></i>
                                                        <?php echo $nome  ?>
                                                    </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="callout callout-info">
                                                        <h5><?php echo "PEDIDO: " . $pedido  ?> </h5>
                                                        <p>
                                                            <h1> <?php echo "Valor: " . $valortotal  ?></h1>
                                                        </p>
                                                        <p>

                                                                                        
                                                            <form action="pegamento_fiado.php" method="POST">

                                                            <input name="saldo" id="" type="hidden" class="form-control validate" value="<?php echo "R$ " . $saldo ?>">
                                                            <input name="mesa" id="" type="hidden" class="form-control validate" value="<?php echo $mesa ?>">
                                                            <input name="preco_total" id="" type="hidden" class="form-control validate" value="<?php echo  $valortotal ?>">
                                                            <input name="pedido" id="" type="hidden" class="form-control validate" value="<?php echo  $pedido ?>">
                                                            <input name="email" id="" type="hidden" class="form-control validate" value="<?php echo  $email ?>">

                                                                <button type="submit" class="btn btn-success float-center"><i class="far fa-credit-card"></i>Pagamento</button>
                                                            </form>
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>


                                    <?php
                                    }
                                    ?>


                                    <thead>
                                        <tr style="text-align:center">
                                            <th>#</th>
                                            <th>Pedido</th>
                                            <th>Valor Unitario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result_usuarios = ("SELECT 
                                            a.nome, a.fone, a.pedido, a.preco_total, a.status, a.created_user, a.created_date,
                                            b.descricao_pedido,b.valor_pedido
                                            
                                            FROM fiado as a LEFT OUTER JOIN pedidos_realizados as b on b.id_pedido = a.pedido
                                            WHERE a.pedido = '$pedido' and a.status = '1' ORDER BY a.created_date DESC");

                                        $recebidos = mysqli_query($conexao, $result_usuarios);
                                        $index = 1;
                                        while ($row = mysqli_fetch_assoc($recebidos)) {

                                        ?>

                                            <tr style="text-align:center">

                                                <td> <?php echo $index ?> </td>
                                                <td> <?php echo $row['descricao_pedido'] ?> </td>
                                                <td> <?php echo $row['valor_pedido'] ?> </td>

                                            </tr>
                                        <?php
                                            $index++;
                                        }
                                        ?>

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