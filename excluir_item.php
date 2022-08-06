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


$pedido = $_POST['pedido'];
if ($pedido == "") {
    exit();
} else {


    $pedido = $_POST['pedido'];
?>
    <form action="salvar_excluir.php" method="POST">
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Excluir Pedido</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <div class="card-body table-responsive p-0">


                                <table id="example1" class="table table-bordered table-striped">

                                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
                                    <thead>
                                        <tr>
                                        <th scope="col">Id Exluir</th>
                                            <th scope="col">Descrição</th>
                                            <th scope="col">Preço Un.</th>
                                            <th scope="col">Preço Total</th>
                                            <th scope="col">Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <h6> Pedido: <?php echo $pedido ?> </h6>
                                        <?php

                                        $select_cliente = ("SELECT cliente FROM `pedidos_realizados` where `status_pedido` = '1' and `id_pedido` = $pedido and `total_pedido` <> '0' group by `cliente` ");
                                        $result_cliente = mysqli_query($conexao, $select_cliente);

                                        while ($cliente = mysqli_fetch_assoc($result_cliente)) {
                                            $cliente_2 = $cliente['cliente'];
                                        }
                                        ?>
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" disabled value="Cliente: <?php echo $cliente_2 ?>">

                                        </div>

                                        <?php

                                        // $result_usuarios = ("SELECT * FROM `pedidos_realizados` where `id_pedido` = '$pedido' and `status_pedido` = '1' ");
                                        $result_usuarios = ("SELECT *, valor_pedido * (total_pedido) as `Soma itens` FROM `pedidos_realizados` where `status_pedido` = '1' and `total_pedido` <> '0' and `id_pedido` = '$pedido' ");

                                        $recebidos = mysqli_query($conexao, $result_usuarios);
                                        $index = 0;
                                        while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                                        ?>

                                            <tr>
                                                <td>
                                                <?php echo $row_usuario['id'] ?>
                                                <input name="pecadetalhe[<?= $index ?>][id]" class="input is-large" value="<?php echo $row_usuario['id'] ?>" type="hidden">

                                                </td>
                                                <td>

                                                    <?php echo $row_usuario['descricao_pedido'] ?>
                                                    <input name="pecadetalhe[<?= $index ?>][descricao]" class="input is-large" value="<?php echo $row_usuario['descricao_pedido'] ?>" type="hidden">
                                                    <input name="pecadetalhe[<?= $index ?>][pedido]" class="input is-large" value="<?php echo $pedido ?>" type="hidden">
                                                    <input name="pecadetalhe[<?= $index ?>][nome_cliente]" class="input is-large" value="<?php echo $cliente_2 ?>" type="hidden">

                                                </td>
                                                <td>
                                                <?php echo $row_usuario['valor_pedido'] ?>

                                                </td>
                                                <td>
                                                    <?php echo $row_usuario['Soma itens'] ?>
                                                    <input name="pecadetalhe[<?= $index ?>][preco]" class="input is-large" value="<?php echo $row_usuario['Total itens'] ?>" type="hidden">
                                                </td>


                                                <td>
                                                <div style="width: 100px" class="btn-group">

                                                        <input class="btn btn-block bg-gradient-danger btn-xs" value="-" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></input>
                                                        <input class="btn btn-block bg-gradient-default btn-xs" name="pecadetalhe[<?= $index ?>][qtde]" min="0" max="<?php echo $row_usuario['total_pedido'] ?>" name="quantity" value="<?php echo $row_usuario['total_pedido'] ?>" type="number">
                                                        <input class="btn btn-block bg-gradient-success btn-xs" value="+" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></input>

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
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
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
            $('#modal-lg').modal('show');
        }
        $(document).ready(function() {
            $('#example').DataTable({
                "pagingType": "full_numbers",
                "ordering": false, // false to disable sorting (or any other option)

            });
        });
    </script>
    </form>

<?php
}
?>

<div class="card-body">
    <div class="card card-primary">
        <div class="card-header">
            <h2 class="card-title">Pedido: <?php echo $pedido ?> </h2>
        </div>
        <!-- /.card-tools -->
        <?php
        $pedido = "SELECT MAX(id_pedido) as 'Pedido' FROM `pedidos_realizados` where `id_pedido` = '$pedido'";
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
                        $soma_total = ("SELECT round(SUM(valor_pedido * total_pedido),2) as `Total Pedido`  FROM `pedidos_realizados` where `status_pedido` = '1' and `id_pedido` = '$pedido'");
                        $recebidos = mysqli_query($conexao, $soma_total);

                        while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                            $total = $row_usuario['Total Pedido'];

                            echo   "SUBTOTAL: R$ " . number_format($total, 2, ',', '.');
                            echo "<br>";
                        };

                        ?>

                    </div>
                    <?php

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


                        $result_usuarios = ("SELECT *, valor_pedido * SUM(total_pedido) as `Soma itens`, SUM(total_pedido) as `Total itens`  FROM `pedidos_realizados` where `status_pedido` = '1' and `id_pedido` = $pedido GROUP by descricao_pedido");
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
                                    <?php echo $row_usuario['valor_pedido'] ?>
                                </td>
                                <td>
                                    <?php echo $row_usuario['Total itens'] ?>
                                </td>
                                <td>
                                    <?php echo $row_usuario['Soma itens'] ?>
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